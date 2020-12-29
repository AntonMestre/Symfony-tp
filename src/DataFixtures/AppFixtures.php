<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Entreprise;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //$faker = Faker\Factory::create('fr_FR');

        $stage1=new Entreprise();
        $stage1->setNom("Safran");
        $stage1->setAdresse("16 rue des pompiers");
        $stage1->setSite("www.safran.com");

        $manager->persist($stage1);

        $manager->flush();
    }
}
