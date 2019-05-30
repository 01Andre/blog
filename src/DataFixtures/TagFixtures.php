<?php


namespace App\DataFixtures;


use App\Entity\Tag;
use Doctrine\Common\Persistence\ObjectManager;

class TagFixtures extends AppFixtures
{
    CONST TAG = ['un tag parmi d\'autres', 'un autre tag', 'tag intéressant', 'supertag'];
    public function load(ObjectManager $manager)
    {
        foreach (self::TAG as $key => $tagName){
            $tag = new Tag();
            $tag->setName($tagName);


            $manager->persist($tag);
            $this->addReference('tag_' . $key, $tag);
        }
        $manager->flush();
    }
}