<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

//use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {

        $serializer = $this->get('jms_serializer');
        $userServices = $this->get('app.user_service');
        $users = $userServices->getUsers();
        $usersJson = $serializer->serialize($users, 'json');

        return $this->render('default/index.html.twig',
            [
                'usersJson' => $usersJson
            ]
        );
    }


}
