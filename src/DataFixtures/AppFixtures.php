<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Post;
use DateTimeImmutable;
use DateTimeZone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categories = [];
        for ($i = 0; $i < 5; $i++) {
            $category = new Category;
            $category->setName("teste de nome $i");
            $category->setCreatedAt(new DateTimeImmutable('now', new DateTimeZone("America/Sao_Paulo")));

            $manager->persist($category);
            $categories[]= $category;
        }

        for ($i = 0; $i < 20; $i++) {
            $post = new Post;
            $key = array_rand($categories);
            $post->setTitle("titulo $i");
            $post->setText("Texto de exempo $i");
            $post->setCategory($categories[$key]);
            $post->setCreatedAt(new DateTimeImmutable('now', new DateTimeZone("America/Sao_Paulo")));
            $manager->persist($post);
        }

        $manager->flush();
    }
}
