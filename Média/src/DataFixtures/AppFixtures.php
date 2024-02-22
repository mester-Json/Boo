<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Book;
use App\Entity\Author;
use App\Entity\Editor;

use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Faker\Factory::create('fr_FR');

        $book = [];

        for ($i = 0; $i < 10; $i++) {
            $book[$i] = new Book();
            $book[$i]->setTittle($faker->sentence(nbWords: 3));
            $author = new Author();
            $author->setName($faker->sentence(nbWords: 3));
            $manager->persist($author);
            $book[$i]->setAutor($author);
            $book[$i]->setCode($faker->regexify('[A-Z]{5}[0-4]{3}'));
            $book[$i]->setPrice($faker->randomFloat(2, 10, 1000));
            $editor = new Editor();
            $editor->setName($faker->sentence(nbWords: 3));
            $editor->setAdress($faker->address);
            $manager->persist($editor);
            $book[$i]->setEditor($editor);
            $manager->persist($book[$i]);
        }
        $manager->flush();

    }
}
