<?php

namespace Listreat\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Listreat\MainBundle\Entity\Shop;
use Listreat\MainBundle\Form\ShopType;
use Listreat\UserBundle\Entity\User;

class ShopController extends Controller
{
    /**
     * @Route("/shops/show/{shop}", name="shops_display")
     * @Template()
     */
    public function showAction(Shop $shop)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        
        $fShop = $this->getDoctrine()
               ->getRepository('Listreat\MainBundle\Entity\Follow')
               ->findBy(array("user"=>$user, "shop"=>$shop));
        
        if ($fShop == null) {
            $followed = false;
        } else $followed = true;
        
        $items = $shop->getItems();
        return array("shop"=>$shop, "items"=>$items, "followed"=>$followed);
    }
    
    /**
     * @Route("/shops/myshops", name="myshops")
     * @Template()
     */
    public function myshopsAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        
        $followed = $this->getDoctrine()->getEntityManager()
                ->getRepository('ListreatMainBundle:Follow')->getFollowedShops($user);
        
        $created = $this->getDoctrine()
               ->getRepository('Listreat\MainBundle\Entity\Shop')
               ->findBy(array('creator'=>$user));
        
        return array("followed" => $followed, "created" => $created);
    }
    
    /**
     * @Route("/shops/list", name="shops_list")
     * @Template()
     */
    public function listAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        
        $shops = $this->getDoctrine()
               ->getRepository('Listreat\MainBundle\Entity\Shop')
               ->findAll();
        
        $users = $this->getDoctrine()
               ->getRepository('Listreat\UserBundle\Entity\User')
               ->findAll();
        
        $friends = $this->getDoctrine()->getEntityManager()
                ->getRepository('ListreatUserBundle:Friend')->getFriendsList($user);
        
        return array("shops"=>$shops, "users"=>$users, "friends"=>$friends);
    }
    
    /**
     * @Route("/shops/create", name="shops_create")
     * @Template()
     */
    public function createAction()
    {
        $shop = new Shop;
        $form = $this->createForm(new ShopType, $shop);

        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
          $form->bind($request);

          if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($shop);
            $em->flush();

            return $this->redirect($this
                    ->generateUrl('shops_update', array('shop'=>$shop->getId())));
          }
        }
        return array("form" => $form->createView());
    }
    
    /**
     * @Route("/shops/update/{shop}", name="shops_update")
     * @Template()
     */
    public function updateAction(Shop $shop)
    {
        $form = $this->createForm(new ShopType, $shop);

        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
          $form->bind($request);

          if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($shop);
            $em->flush();

            return $this->redirect($this
                    ->generateUrl('shops_update', array('shop'=>$shop->getId())));
          }
        }
        $items = $shop->getItems();
        
        return array("shop" => $shop, "items" => $items, "form" => $form->createView());
    }
}
