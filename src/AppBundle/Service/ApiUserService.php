<?php
/**
 * Created by PhpStorm.
 * User: marscheung
 * Date: 7/16/17
 * Time: 10:58 PM
 */

namespace AppBundle\Service;

use AppBundle\Entity\ApiUser;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiUserService
{

    protected $em;
    protected $userRepo;

    public function __construct(
        EntityManager $entityManager,
        EntityRepository $userRepository
    ) {
        $this->em       = $entityManager;
        $this->userRepo = $userRepository;
    }

    public function getUsers()
    {
        return $this->userRepo->findAll();
    }

    public function createUser(Request $request)
    {

        $userData = $request->request->all();
        $user = new ApiUser();

        $user->setUsername($userData['username']);
        $user->setFirstName($userData['first_name']);
        $user->setEmail($userData['email']);
        $user->setLastName($userData['last_name']);
        $user->setPassword(password_hash($userData['password'], PASSWORD_DEFAULT));
        $this->em->persist($user);
        $this->em->flush();
        return $user;
    }
}