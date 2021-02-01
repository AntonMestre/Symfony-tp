<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Repository\StageRepository;
use App\Repository\EntrepriseRepository;
use App\Repository\FormationRepository;

class ProStageController extends AbstractController
{

    /*
    * Controller de la page d'accueil (nommée index ci-dessous)
    */
    public function index(StageRepository $repositoryStage): Response
    {
       // Récupérer les stages enregistrées en BD
       $stages = $repositoryStage->findAllOptimized();

       // Envoyer les stages récupérées à la vue chargée de les afficher
      return $this->render('pro_stage/index.html.twig',['stages'=>$stages]);
    }

    /*
    * Controller de la page des stages classés par entreprise
    */
    public function entreprise(EntrepriseRepository $repositoryEntreprise): Response
    {
        // Récupérer les entreprises enregistrées en BD
        $entreprises = $repositoryEntreprise->findAll();

        return $this->render('pro_stage/entreprise.html.twig',['entreprises'=>$entreprises]);
    }

    /*
    * Controller de la page des stages classés par formation
    */
    public function formation(FormationRepository $repositoryFormation): Response
    {
       // Récupérer les formations enregistrées en BD
       $formations = $repositoryFormation->findAll();

       return $this->render('pro_stage/formation.html.twig',['formations'=>$formations]);
    }

    /*
    * Controller de la page permettant de voir les détails d'un stage
    */
    public function stage(Stage $stage): Response
    {
       // Envoyer le stage récupérés à la vue chargée de les afficher
        return $this->render('pro_stage/stage.html.twig', [
            'stage' => $stage,
        ]);
    }

    /*
    * Controller de la page permettant de voir les stages d'une entreprise
    */
    public function stageEntreprise(StageRepository $repositoryStage,$nomEntreprise): Response
    {
       // Récupérer l'entreprise demandée
       $stages = $repositoryStage->findOneByNomEntreprise($nomEntreprise);

       // Envoyer l'entreprise récupérées à la vue chargée de les afficher
        return $this->render('pro_stage/stageEntreprise.html.twig', [
            'stages' => $stages,
            'nomEntreprise' => $nomEntreprise,
        ]);
    }

    /*
    * Controller de la page permettant de voir les stages d'une entreprise
    */
    public function stageFormation(StageRepository $repositoryStage,$nomFormation): Response
    {

       // Récupérer la formation demandée
       $stages = $repositoryStage->findOneByNomFormation($nomFormation);

       // Envoyer la formation récupérées à la vue chargée de les afficher
        return $this->render('pro_stage/stageFormation.html.twig', [
            'stages' => $stages,
            'nomFormation' => $nomFormation,
        ]);
    }

}
