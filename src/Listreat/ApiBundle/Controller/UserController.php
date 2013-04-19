<?php

namespace Listreat\ApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Listreat\UserBundle\Entity\Friend;
use Listreat\UserBundle\Entity\User;

class UserController extends ApiController
{
    /**
     * @Route("/users")
     * @Template()
     */
    public function listAction()
    {
      $users = $this->getDoctrine()->getEntityManager()->getRepository('ListreatUserBundle:User')->findAll();
      $this->setResponseData($users);
      return $this->renderResponse();
    }
    
    /**
     * @Route("/users/{id}")
     * @Template()
     */
    public function getAction($id)
    {
        $user = $this->getDoctrine()->getEntityManager()->getRepository('ListreatUserBundle:User')->find($id);
        $shops = $this->getDoctrine()->getEntityManager()->getRepository('ListreatMainBundle:Shop')->findByCreator($id);
        $data = array("user"=>$user, "shops"=>$shops);
        $this->setResponseData($data);
        return $this->renderResponse();
    }
    
    /**
     * @Route("/friend/{user}/{friend}", name="friend")
     * @Template()
     */
    public function friendAction(User $user, User $friend)
    {
        $friendship = $this->getDoctrine()
               ->getRepository('Listreat\UserBundle\Entity\Friend')
               ->findBy(array("user"=>$user, "friend"=>$friend));
        
        if ($friendship == null) {
            $friendship = new Friend;
            $friendship->setFriend($friend);
            $friendship->setUser($user);
            
            $friendship2 = new Friend;
            $friendship2->setFriend($user);
            $friendship2->setUser($friend);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($friendship);
            $em->persist($friendship2);
            $em->flush();
            
            $result = array("success"=>"You have a new friend !");
        }
        else $result = array("error"=>"You are already friend with this guy");
        
        $this->setResponseData($result);
        return $this->renderResponse();
    }
}