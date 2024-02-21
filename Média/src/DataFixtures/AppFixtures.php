<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Book;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Faker\Factory::create('fr_FR');

        $persone = [];

        for ($i = 0; $i < 10; $i++) {
            $persone[$i] = new Book();
            $persone[$i]->setTittle($faker->sentence(nbWords: 3));
            $persone[$i]->setAuthor($faker->name);
            $persone[$i]->setCode($faker->regexify('[A-Z]{5}[0-4]{3}'));
            $persone[$i]->setPrice($faker->randomFloat(2, 10, 1000));
            $manager->persist($persone[$i]);
        }
        $manager->flush();
    }
}
