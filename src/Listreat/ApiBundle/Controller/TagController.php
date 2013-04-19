<?php

namespace Listreat\ApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Listreat\MainBundle\Form\ShopType;
use Listreat\MainBundle\Entity\Tag;

class TagController extends ApiController
{
    
    // A faire ici :
    // - liste des N tags les plus utilisés avec 1 liste de tags donnée (nulle éventuellement)
    // - ajout d'1 tag
    // - recherche de tags
    // - nouveau lien d'1 shop à 1 tag
    // - liste des shops liés à 1 combinaison de tags
    
    /**
     * @Route("/tags/list")
     * @Template()
     */
    public function listAction()
    {
        $tags = $this->getDoctrine()->getEntityManager()->getRepository('ListreatMainBundle:Tag')->findAll();
        $this->setResponseData($tags);
        return $this->renderResponse();
    }
    
    /**
     * @Route("/tags/create/{name}")
     * @Template()
     */
    public function createAction($name)
    {
        $tag = new Tag;
        $tag->setName($name);
        $em = $this->getDoctrine()->getManager();
        $em->persist($tag);
        $em->flush();
    }
}