<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\UserType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {

    }

    /**
     * @Route("/inscription", name="app_inscription")
     */
    public function Inscription(Request $request, ManagerRegistry $manager, UserPasswordEncoderInterface $encoder): Response
    {

        $utilisateur = new User();


        $formulaireUtilisateur = $this->createForm(UserType::class, $utilisateur);


        $formulaireUtilisateur->handleRequest($request);

        if ($formulaireUtilisateur->isSubmitted() && $formulaireUtilisateur->isValid()) {

           $utilisateur->setRoles(['ROLE_USER']);

           $encodagePassword = $encoder->encodePassword($utilisateur, $utilisateur->getPassword());
           $utilisateur->setPassword($encodagePassword);

            $manager->getManager()->persist($utilisateur);
            $manager->getManager()->flush();


            return $this->redirectToRoute('index');
        }


        return $this->render('security/inscription.html.twig', ['vueFormulaire' => $formulaireUtilisateur->createView(), 'action' => "Ajouter"]);
    }


}
