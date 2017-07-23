<?php
/**
 * Created by PhpStorm.
 * User: marscheung
 * Date: 7/23/17
 * Time: 2:01 PM
 */

namespace AppBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class UsersController extends FOSRestController
{


    public function getAllUsersAction(Request $request)
    {

        $serializer = $this->get('jms_serializer');
        $userServices = $this->get('app.user_service');
        $users = $userServices->getUsers();
        $users = $serializer->serialize($users, 'json');
//var_dump(json_encode($users));die;
        return new Response(json_encode($users),200);
    }

    public function createUserAction(Request $request)
    {

        $serializer = $this->get('jms_serializer');
        $userServices = $this->get('app.user_service');
        $user = $userServices->createUser($request);
        $user = $serializer->serialize($user, 'json');


        return new JsonResponse([
            'success'=>true,
            'data'=>$user
        ], 200);

    }
}