<?php

namespace Listreat\ApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Listreat\MainBundle\Form\ShopType;
use Listreat\MainBundle\Entity\Shop;
use Listreat\UserBundle\Entity\User;

class TagController extends ApiController
{
    
    // A faire ici :
    // - liste des N tags les plus utilisés avec 1 liste de tags donnée (nulle éventuellement)
    // - ajout d'1 tag
    // - recherche de tags
    // - nouveau lien d'1 shop à 1 tag
    // - liste des shops liés à 1 combinaison de tags
    
    /**
     * @Route("/shops")
     * @Template()
     */
    public function listAction()
    {
      $events = $this->getDoctrine()->getEntityManager()->getRepository('ListreatMainBundle:Shop')->findAll();
      $this->setResponseData($events);
      return $this->renderResponse();
    }
    
    /**
     * @Route("/shops/get/{id}")
     * @Template()
     */
    public function getAction(Shop $shop)
    {
        $this->setResponseData($shop);
        return $this->renderResponse();
    }
    
    /**
     * @Route("/shops/new/{creator}")
     * @Template()
     */
    public function newAction(User $creator)
    {
        $shop = new Shop;
        
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST')
        {
            $shop->setName($request->request->get('name'));
            $shop->setDescription($request->request->get('description'));
            $shop->setCreator($creator);
                
            $em = $this->getDoctrine()->getManager();
            $em->persist($shop);
            $em->flush();
            
            $result = $shop;
        }
        else $result = array("result"=>"POST method error");
        $this->setResponseData($result);
        return $this->renderResponse();
    }
    
    /**
     * @Route("/shops/update/{shop}")
     * @Template()
     */
    public function updateAction(Shop $shop)
    {
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST')
        {
            $shop->setName($request->request->get('name'));
            $shop->setDescription($request->request->get('description'));
                
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            
            $result = $shop;
        }
        else $result = array("result"=>"POST method error");
        $this->setResponseData($result);
        return $this->renderResponse();
    }
}