<?php


namespace App\Controller;


use App\Repository\UserRepository;

class UserController extends AbstractController
{
 /**
  * @Route("/Users", name = "app_users")
  *
  *
  */
 public function getAllUsers(){
    return $users= $this.getDoctrine()->
        getRepository('UserRepository')->
        findAll();
 }
}