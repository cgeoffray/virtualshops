<?php

namespace Listreat\ApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Listreat\UserBundle\Entity\User;
use Listreat\MainBundle\Entity\Shop; 
use Listreat\MainBundle\Entity\Follow;

class FollowController extends ApiController
{   
    /**
     * @Route("/fshops/{user}", name="fshops")
     * @Template()
     */
    public function fshopsAction(User $user)
    {
        $fShops = $user->getFShops()->getShop();  // surement à changer : N2 recherches
        $this->setResponseData($fShops);
        return $this->renderResponse();
    }
    
    /**
     * @Route("/follow/{user}/{shop}", name="follow")
     * @Template()
     */
    public function followAction(User $user, Shop $shop)
    {
        $fShop = $this->getDoctrine()
               ->getRepository('Listreat\MainBundle\Entity\Follow')
               ->findBy(array("user"=>$user, "shop"=>$shop));
        
        if ($fShop == null) {
            $follow = new Follow;
            $follow->setShop($shop);
            $follow->setUser($user);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($follow);
            $em->flush();
            
            $result = array("success"=>"You now follow this shop");
        }
        else $result = array("error"=>"You already follow this shop");
        
        $this->setResponseData($result);
        return $this->renderResponse();
    }
    
    /**
     * @Route("/unfollow/{user}/{shop}", name="unfollow")
     * @Template()
     */
    public function unfollowAction(User $user, Shop $shop)
    {
        $fShop = $this->getDoctrine()
               ->getRepository('Listreat\MainBundle\Entity\Follow')
               ->findOneBy(array("user"=>$user, "shop"=>$shop));
        
        if ($fShop != null) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fShop);
            $em->flush();
            
            $result = array("success"=>"You successfuly unfollowed this shop");
        }
        else $result = array("error"=>"You don't follow this shop");
        
        $this->setResponseData($result);
        return $this->renderResponse();
    }
    
    /**
     * @Route("/follow/check/{user}/{shop}", name="follow_check")
     * @Template()
     */
    public function checkAction(User $user, Shop $shop)
    {
        $fShop = $this->getDoctrine()
               ->getRepository('Listreat\MainBundle\Entity\Follow')
               ->findBy(array("user"=>$user, "shop"=>$shop));
        
        if ($fShop == null) {
            $result = array("followed"=>false);
        }
        else $result = array("followed"=>true);
        
        $this->setResponseData($result);
        return $this->renderResponse();
    }
}