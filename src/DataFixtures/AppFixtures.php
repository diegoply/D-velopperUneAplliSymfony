<?php

namespace App\DataFixtures;

use App\Entity\Marque;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $marque = new Marque();
        $marque->setLibelle('KTM');
        $manager->persist($marque);

        $marque2 = new Marque();
        $marque2->setLibelle('BMW');
        $manager->persist($marque2);

        $marque3 = new Marque();
        $marque3->setLibelle('Suzuky');
        $manager->persist($marque3);
       
        $marque4 = new Marque();
        $marque4->setLibelle('Honda');
        $manager->persist($marque4);
        
        $manager->flush();
    }
}
