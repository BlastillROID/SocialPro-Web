<?php

namespace SocialProBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{

    public function showUsersAction(){
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();
        return $this->render("SocialProBundle:Admin:userlist.html.twig", ['users' => $users]);
    }
}
