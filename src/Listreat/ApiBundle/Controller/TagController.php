<?php

namespace Listreat\ApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Listreat\MainBundle\Form\ShopType;
use Listreat\MainBundle\Entity\Tag;
use Listreat\MainBundle\Entity\Shop;

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
     * @Route("/tags/create/{shop}/{tags}")
     * @Template()
     */
    public function createTagsAction(Shop $shop, $tags)
    {
        // tags is a string where several tags are separated by ","
        $tagManager = $this->get('fpn_tag.tag_manager');

        // ask the tag manager to create a Tag object
        $tagNames = $tagManager->splitTagNames($tags);
        $fooTag = $tagManager->loadOrCreateTag($tagNames);

        // assign the foo tag to the post
        $tagManager->addTag($fooTag, $shop);

        $em = $this->getDoctrine()->getEntityManager();

        // persist and flush the new post
        $em->persist($shop);
        $em->flush();

        // after flushing the post, tell the tag manager to actually save the tags
        $tagManager->saveTagging($shop);

        // ...

        // Load tagging ...
        $tagManager->loadTagging($shop);
    }
    
    /**
     * @Route("/tags/link/{shop}/{name}")
     * @Template()
     */
    public function linkAction(Shop $shop, $name)
    {
        $tag = $this->getDoctrine()->getEntityManager()->getRepository('ListreatMainBundle:Tag')
                ->findOneBy(array('name'=>$name));
        if (!isset($tag)) {
            $tag = new Tag;
            $tag->setName($name);
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();
        }
        $shop->addTag($tag);
        
        $this->setResponseData($tags);
        return $this->renderResponse();
    }
}