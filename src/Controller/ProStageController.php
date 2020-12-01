<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProStageController extends AbstractController
{

    public function index(): Response
    {
        return $this->render('pro_stage/index.html.twig');
    }

    public function entreprise(): Response
    {
        return $this->render('pro_stage/entreprise.html.twig');
    }

    public function formation(): Response
    {
        return $this->render('pro_stage/formation.html.twig');
    }

    public function stage($id): Response
    {
        return $this->render('pro_stage/stage.html.twig', [
            'id' => $id,
        ]);
    }

}
