<?php

namespace Listreat\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Listreat\UserBundle\Entity\User;

class UserController extends Controller
{
    /**
     * @Route("/profil/{id}", name="profil")
     * @Template()
     */
    public function indexAction(User $user)
    {
        $fShops = $user->getFShops();
        return array("user"=>$user, "fShops"=>$fShops);
    }
}
