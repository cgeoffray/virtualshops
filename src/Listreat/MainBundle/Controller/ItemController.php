<?php

namespace Listreat\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Listreat\MainBundle\Entity\Item;
use Listreat\MainBundle\Entity\Shop;
use Listreat\MainBundle\Form\ItemType;
use Listreat\UserBundle\Entity\User;

class ItemController extends Controller
{
    /**
     * @Route("/items/create/{shop}", name="items_create")
     * @Template()
     */
    public function createAction(Shop $shop)
    {
        $item = new Item;
        $item->setShop($shop);
        $form = $this->createForm(new ItemType, $item);

        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
          $form->bind($request);

          if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();

            return $this->redirect($this
                    ->generateUrl('items_update', array('item'=>$item->getId())));
          }
        }
        return array("form" => $form->createView());
    }
    
    /**
     * @Route("/items/update/{item}", name="items_update")
     * @Template()
     */
    public function updateAction(Item $item)
    {
        $form = $this->createForm(new ItemType, $item);

        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
          $form->bind($request);

          if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();

            return $this->redirect($this
                    ->generateUrl('items_update', array('item'=>$item->getId())));
          }
        }
        return array("item" => $item, "form" => $form->createView());
    }
}
