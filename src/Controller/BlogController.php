<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Tag;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use \Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class BlogController extends AbstractController
{
    /**
     * Show all row from article's entity
     * @Route ("/",name="homepage")
     * @Route("/", name="blog_index")
     * @return Response A response instance
     */
    public function index(): Response
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();
        if (!$articles) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }

        return $this->render(
            'blog/index.html.twig',
            ['articles' => $articles,]
        );
    }

    /**
     * Getting a article with a formatted slug for title
     *
     * @param string $articleName The slugger
     *
     * @Route("show/{articleSlug}",
     *     name="blog_show")
     * @return Response A response instance
     */
    public function show(string $articleSlug): Response
    {
        if (!$articleSlug) {
            throw $this
                ->createNotFoundException('No article name has been sent to find an article in article\'s table.');
        }
        $articleName = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($articleSlug)), "-")
        );
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneBy(['slug' =>$articleSlug]);
        if (!$article) {
            throw $this->createNotFoundException(
                'No article with ' . $articleSlug . ' title, found in article\'s table.'
            );
        }
        return $this->render(
            'blog/show.html.twig',
            [
                'article' => $article,
                'articleName' => $articleName,
            ]
        );
    }

    /**
     * Getting a category with a formatted slug for title
     * @Route("/show/category/{name}", name="show_category")
     * @ParamConverter("category", class="App\Entity\Category")
     */
    public function showByCategory(Category $category): Response
    {
        return $this->render(
            'blog/category.html.twig',
            [
                'category' => $category
            ]
        );
    }

    /**
     * Getting a category with a formatted slug for title
     * @Route("show/tag/{name}", name="show_tag")
     * @ParamConverter("tag", class="App\Entity\Tag")
     */
    public function showByTag(Tag $tag): Response
    {
        return $this->render(
            'blog/tag.html.twig',
            [
                'tag' => $tag
            ]
        );
    }
}
