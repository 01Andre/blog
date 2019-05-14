<?php
// src/Controller/BlogController.php
namespace App\Controller;


use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class NavbarController extends AbstractController
{

    public function navbar(){
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();
        return $this->render(
            'navbar.html.twig',
            ['categories' => $categories,
                'articles' => $articles]
        );

    }

}