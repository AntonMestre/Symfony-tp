<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formation;

class ProStageController extends AbstractController
{

    /*
    * Controlleur de la page d'accueil (nommée index ci-dessous)
    */
    public function index(): Response
    {
      // Récupérer le repository de l'entité Stage
     $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);

     // Récupérer les stages enregistrées en BD
     $stages = $repositoryStage->findAll();

     // Envoyer les stages récupérées à la vue chargée de les afficher
    return $this->render('pro_stage/index.html.twig',['stages'=>$stages]);
    }

    /*
    * Controlleur de la page des stages classés par entreprise
    */
    public function entreprise(): Response
    {
      // Récupérer le repository de l'entité Stage
      $repositoryEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);

      //$querye = $repositoryEntreprise->createQueryBuilder('en');
      //$entreprises = $querye->select('en.nom')->groupBy('en.nom')->getQuery()->getResult();

      // Récupérer les stages enregistrées en BD
      $entreprises = $repositoryEntreprise->findAll();

      return $this->render('pro_stage/entreprise.html.twig',['entreprises'=>$entreprises]);
    }

    /*
    * Controlleur de la page des stages classés par formation
    */
    public function formation(): Response
    {

      // Récupérer le repository de l'entité Stage
     $repositoryFormation = $this->getDoctrine()->getRepository(Formation::class);

     // Récupérer les stages enregistrées en BD
     $formations = $repositoryFormation->findAll();

     return $this->render('pro_stage/formation.html.twig',['formations'=>$formations]);
    }

    /*
    * Controlleur de la page permettant de voir les détails d'un stage
    */
    public function stage($id): Response
    {
        // Récupérer le repository de l'entité Stage
       $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);

       // Récupérer le stage demandé
       $stage = $repositoryStage->find($id);

       // Envoyer le stage récupérées à la vue chargée de les afficher
        return $this->render('pro_stage/stage.html.twig', [
            'stage' => $stage,
        ]);
    }

}
