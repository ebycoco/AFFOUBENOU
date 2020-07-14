<?php

namespace App\DataFixtures;

use App\Entity\Temoignages;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class TemoignageFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker= Factory::create('fr_FR');
        for ($i=1; $i <= 8; $i++) { 
            $temoignage = new Temoignages();  
            $temoignage->setUsername($faker->name)
                    ->setContenue($faker->paragraph(2))
                    ->setImageName($faker->imageUrl())
                    ;
                        

            $manager->persist($temoignage);
        }

        $manager->flush();
    }
}
