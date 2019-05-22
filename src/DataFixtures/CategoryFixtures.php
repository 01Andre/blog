<?php


namespace App\DataFixtures;


use App\Entity\Category;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends AppFixtures
{
    CONST CATEGORIES = ['PHP', 'Javascript', 'Ruby', 'DevOps', 'Blablablouc'];
public function load(ObjectManager $manager)
{
    foreach (self::CATEGORIES as $key => $categoryName){
    $category = new Category();
    $category->setName($categoryName);


        $manager->persist($category);
        $this->addReference('categorie_' . $key, $category);
    }
    $manager->flush();
}
}