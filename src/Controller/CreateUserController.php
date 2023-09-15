<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class CreateUserController extends AbstractController
{
    #[Route('/createuser', name: 'app_create_user')]
    public function index(UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $newUser = new User();
        $newUser->setEmail('superadmin@lycee-faure.fr');
        $newUser->setRoles(['ROLE_SUPER_ADMIN']);
        $plaintextPassword = '1234test';

        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $passwordHasher->hashPassword(
            $newUser,
            $plaintextPassword
        );
        $newUser->setPassword($hashedPassword);

        $entityManager->persist($newUser);
        $entityManager->flush();

        return $this->render('create_user/index.html.twig', [
            'controller_name' => 'CreateUserController',
        ]);
    }
}
