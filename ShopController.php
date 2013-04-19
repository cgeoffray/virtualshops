<?php

namespace Listreat\ApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Listreat\MainBundle\Form\ShopType;
use Listreat\MainBundle\Entity\Shop;

class ShopController extends ApiController
{
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
     * @Route("/shops/{id}")
     * @Template()
     */
    public function getAction(Shop $shop)
    {
        $this->setResponseData($shop);
        return $this->renderResponse();
    }
    
    /**
     * @Route("/shops/new")
     * @Template()
     */
    public function newAction()
    {
        $shop = new Shop;
        //$form = $this->get('form.factory')->create(new ShopType());
        $request = $this->get('request');
        if ($request->getMethod() == 'POST')
        {
            $shop->bindRequest($request);
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($shop);
            $em->flush();
        }
        $this->setResponseData($shop);
        return $this->renderResponse();
    }
    
    /**
     * @Route("/shops/update/{id}")
     * @Template()
     */
    public function updateAction(Shop $shop)
    {
        $form = $this->createForm(new ShopType, $shop);
        $request = $this->get('request');
        
        if ($request->getMethod() == 'POST')
        {
            $form->bind($request);
            //if ($form->isValid()) {
                
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                $result = "ok";
            //}
            //else $result = array("result"=>"error");
        }
        else $result = array("result"=>"error");
        $this->setResponseData($result);
        return $this->renderResponse();
    }
}