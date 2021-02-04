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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Persistence\EntityManagerInterface;

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


    /*
    * Controller de la page permettant d'ajouter une entreprise
    */
    public function ajouterEntreprise(Request $request,EntityManagerInterface $manager): Response
    {
      //Création d'une ressource vierge qui sera remplie par le formulaire
       $entreprise = new Entreprise();

       // Création du formulaire permettant de saisir une ressource
       $formulaireEntreprise = $this->createFormBuilder($entreprise)
       ->add('nom',TextType::class)
       ->add('adresse',TextType::class)
       ->add('site',UrlType::class)
       ->getForm();

       /* On demande au formulaire d'analyser la dernière requête Http. Si le tableau POST contenu
      dans cette requête contient des variables titre, descriptif, etc. alors la méthode handleRequest()
      récupère les valeurs de ces variables et les affecte à l'objet $ressource*/
      $formulaireEntreprise->handleRequest($request);

       if ($formulaireEntreprise->isSubmitted() )
       {
          // Enregistrer la ressource en base de donnéelse
          $manager->persist($entreprise);
          $manager->flush();

          // Rediriger l'utilisateur vers la page d'accueil
          return $this->redirectToRoute('accueil');
       }

       // Envoyer la formation récupérées à la vue chargée de les afficher
        return $this->render('pro_stage/ajoutEntreprise.html.twig',['vueFormulaire' => $formulaireEntreprise->createView()]);
    }
}
