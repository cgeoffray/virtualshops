<?php

namespace Listreat\ApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Listreat\MainBundle\Form\ShopType;
use Listreat\MainBundle\Entity\Shop;
use Listreat\MainBundle\Entity\Item;

class ItemController extends ApiController
{
    /**
     * @Route("/items/get/{id}")
     * @Template()
     */
    public function getAction(Item $item)
    {
        $this->setResponseData($item);
        return $this->renderResponse();
    }
    
    /**
     * @Route("/items/new/{shop}")
     * @Template()
     */
    public function newAction(Shop $shop)
    {
        $item = new Item;
        
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST')
        {
            $item->setTitle($request->request->get('title'));
            $item->setDescription($request->request->get('description'));
            $item->setLink($request->request->get('link'));
            $item->setShop($shop);
                
            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();
            
            $result = $item;
        }
        else $result = array("result"=>"POST method error");
        $this->setResponseData($result);
        return $this->renderResponse();
    }
    
    /**
     * @Route("/items/update/{item}")
     * @Template()
     */
    public function updateAction(Item $item)
    {
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST')
        {
            $item->setTitle($request->request->get('title'));
            $item->setDescription($request->request->get('description'));
            $item->setLink($request->request->get('link'));
            
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            
            $result = $item;
        }
        else $result = array("result"=>"POST method error");
        $this->setResponseData($result);
        return $this->renderResponse();
    }
    
    /**
     * @Route("/items/delete/{item}", name="items_delete")
     * @Template()
     */
    public function deleteAction(Item $item)
    {
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST')
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($item);
            $em->flush();
            $result = array("result"=>"item removed");
        }
        else $result = array("result"=>"failed");
        $this->setResponseData($result);
        return $this->renderResponse();
    }
}