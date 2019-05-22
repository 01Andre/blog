<?php


namespace App\DataFixtures;


use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <=50; $i++) {
            $faker = Faker\Factory::create('fr_FR');
            $article = new Article();
            $article->setTitle(mb_strtolower($faker->word));
            $sentence = mb_strtolower($faker->sentences($nb = 3, $asText = true));
            $article->setContent($sentence);
            $manager->persist($article);
            $y = $faker->numberBetween($min = 0, $max = 4);
            $article->setCategory($this->getReference('categorie_' . $y));
            $manager->flush();
        }

    }
}