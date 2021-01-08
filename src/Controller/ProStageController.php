<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProStageController extends AbstractController
{

    /*
    * Controlleur de la page d'accueil (nommée index ci-dessous)
    */
    public function index(): Response
    {
        return $this->render('pro_stage/index.html.twig');
    }

    /*
    * Controlleur de la page des stages classés par entreprise
    */
    public function entreprise(): Response
    {
        return $this->render('pro_stage/entreprise.html.twig');
    }

    /*
    * Controlleur de la page des stages classés par formation
    */
    public function formation(): Response
    {
        return $this->render('pro_stage/formation.html.twig');
    }

    /*
    * Controlleur de la page permettant de voir les détails d'un stage
    */
    public function stage($id): Response
    {
        return $this->render('pro_stage/stage.html.twig', [
            'id' => $id,
        ]);
    }

}
