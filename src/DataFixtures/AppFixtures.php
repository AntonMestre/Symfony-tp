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

        $dutInfo = new Formation();
        $dutInfo -> setTitre("Dut informatique");
        $dutInfo -> setDescription($faker->realText($maxNbChars = 200, $indexSize = 2));

        $ecoldeInge = new Formation();
        $ecoldeInge -> setTitre("Ecole d'ingénieur informatique");
        $ecoldeInge -> setDescription($faker->realText($maxNbChars = 200, $indexSize = 2));

        $licence = new Formation();
        $licence -> setTitre("Licence 3 informatique");
        $licence -> setDescription($faker->realText($maxNbChars = 200, $indexSize = 2));

        $bts = new Formation();
        $bts -> setTitre("BTS SIO");
        $bts -> setDescription($faker->realText($maxNbChars = 200, $indexSize = 2));

        $tableauFormations = array($dutInfo,$ecoldeInge,$licence,$bts);

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

          for($o=0; $o < $faker->numberBetween($min = 0, $max = 3);$o++){

            $stage=new Stage();
            $stage->setTitre($faker->realText($maxNbChars = 50, $indexSize = 2));
            $stage->setActivite($faker->realText($maxNbChars = 50, $indexSize = 2));
            $stage->setEmail($faker->companyEmail());
            $stage->setEntreprise($entreprise);

            $nbrFormation = $faker->numberBetween($min = 0, $max = 3);

            for($m=0;$m<$nbEntreprise;$m++){

              $laFormation = $faker->numberBetween($min = 0, $max = 3);
              $stage->addFormation($tableauFormations[$laFormation]);
              $tableauFormations[$laFormation]->addStage($stage);
            }

            $manager->persist($stage);
            $manager->persist($tableauFormations[$laFormation]);
          }

        }

        $manager->flush();
    }
}
