<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $cat1 = new Category();
        $cat1->setTitle('famille');

        $cat2 = new Category();
        $cat2->setTitle('amis');

        $cat3 = new Category();
        $cat3->setTitle('travail');

        $manager->persist($cat1);
        $manager->persist($cat2);
        $manager->persist($cat3);
        
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
