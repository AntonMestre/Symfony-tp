<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Entreprise;
use App\Entity\Stage;
use App\Entity\Formation;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        /////////////////////////////////////////////////////////////
        // Génération des données de test pour l'entité Formation  //
        /////////////////////////////////////////////////////////////

        // Création de la formation : DUT Informatique avec sa description
        $dutInfo = new Formation();
        $dutInfo -> setTitre("Dut informatique");
        $dutInfo -> setDescription($faker->realText($maxNbChars = 200, $indexSize = 2));

        // Création de la formation : Ecole d'ingenieur avec sa description
        $ecoldeInge = new Formation();
        $ecoldeInge -> setTitre("Ecole d'ingénieur informatique");
        $ecoldeInge -> setDescription($faker->realText($maxNbChars = 200, $indexSize = 2));

        // Création de la formation : Licence 3 informatique avec sa description
        $licence = new Formation();
        $licence -> setTitre("Licence 3 informatique");
        $licence -> setDescription($faker->realText($maxNbChars = 200, $indexSize = 2));

        // Création de la formation : BTS SIO avec sa description
        $bts = new Formation();
        $bts -> setTitre("BTS SIO");
        $bts -> setDescription($faker->realText($maxNbChars = 200, $indexSize = 2));

        // Création d'un tableau pour faciliter l'envoie en base de données
        $tableauFormations = array($dutInfo,$ecoldeInge,$licence,$bts);

        // Boucle pour créer les formations en base de données
        foreach ($tableauFormations as $formation) {
            $manager->persist($formation);
        }

        /////////////////////////////////////////////////////////////
        // Génération des données de test pour l'entité Entreprise //
        /////////////////////////////////////////////////////////////

        // Nombre d'entreprise qui seront générées
        $nbEntreprise=15;
        for($i=0; $i <= $nbEntreprise; $i++){

          // Création d'une entreprise
          $entreprise=new Entreprise();

          // Génération du nom de l'entreprise
          $entreprise->setNom($faker->company());

          // Génération de l'adresse
          $entreprise->setAdresse($faker->address());

          // Génération du siteweb
          $entreprise->setSite($faker->domainName());

          // Enregistrement de l'entreprise créer
          $manager->persist($entreprise);

          // Création des stages (entre 0 et 3 pour chaque entreprise)
          for($o=0; $o < $faker->numberBetween($min = 0, $max = 3);$o++){

            // Création du stage avec son titre, l'activité, l'email et l'entreprise rattaché
            $stage=new Stage();
            $stage->setTitre($faker->realText($maxNbChars = 50, $indexSize = 2));
            $stage->setActivite($faker->realText($maxNbChars = 50, $indexSize = 2));
            $stage->setEmail($faker->companyEmail());
            $stage->setEntreprise($entreprise);

            // Nombre de formation rattaché au stage (entre 1 et 3 maximum)
            $nbrFormation = $faker->numberBetween($min = 1, $max = 3);
            for($m=0;$m<$nbrFormation;$m++){

              // Tirage d'un chiffre pour choisir parmis les formations du tableau laquelle sera choisie
              $laFormation = $faker->numberBetween($min = 0, $max = 3);

              // Ajout de la formtation au stage (et inversement)
              $stage->addFormation($tableauFormations[$laFormation]);
              $tableauFormations[$laFormation]->addStage($stage);
            }

            // Application sur la BD
            $manager->persist($stage);
            $manager->persist($tableauFormations[$laFormation]);
          }

        }

        $manager->flush();
    }
}
