<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProStageController extends AbstractController
{

    public function index(): Response
    {
        return $this->render('pro_stage/index.html.twig', [
            'controller_name' => 'ProStageController',
        ]);
    }

    public function entreprises(): Response
    {
        return $this->render('pro_stage/index.html.twig', [
            'controller_name' => 'Cette page affichera la liste des entreprises proposant un stage',
        ]);
    }

    public function formations($id): Response
    {
        return $this->render('pro_stage/index.html.twig', [
            'controller_name' => 'Cette page affichera le descriptif du stage ayant pour identifiant '.$id,
        ]);
    }

}
