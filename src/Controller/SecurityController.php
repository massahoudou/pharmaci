<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils,UsersRepository $usersRepository,EntityManagerInterface $entityManagerInterface,UserPasswordHasherInterface $encoder): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }
            $user = $usersRepository->findOneBy(['identifiant'=> 'admin']) ;
            if(!$user)
            {
                $user = new Users() ;
                $password = 123456;
                $encoderpassword = $encoder->hashPassword($user,$password);
                $user->setNom('admin')->setPrenom('admin')->setPin(1234)->setIdentifiant('admin')->setMotdepasse($encoderpassword);
                $entityManagerInterface->persist($user);
                $entityManagerInterface->flush();

            }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
