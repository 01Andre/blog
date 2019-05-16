<?php
// src/Controller/BlogController.php
namespace App\Controller;
use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
            ['articles' => $articles]
        );
    }
    /**
     * Getting a article with a formatted slug for title
     *
     * @param string $articleName The slugger
     *
     * @Route("show/{articleName<^[A-Za-z0-9- ]+$>}",
     *     defaults={"articleName" = null},
     *     name="blog_show")
     * @return Response A response instance
     */
    public function show(string $articleName): Response
    {
        if (!$articleName) {
            throw $this
                ->createNotFoundException('No article name has been sent to find an article in article\'s table.');
        }
        $articleName = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($articleName)), "-")
        );
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneBy(['title' => mb_strtolower($articleName)]);
        if (!$article) {
            throw $this->createNotFoundException(
                'No article with ' . $articleName . ' title, found in article\'s table.'
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
     *
     *
     * @Route("category/{categoryName<^[A-Za-z0-9- ]+$>}",
     *     defaults={"categoryName" = null},
     *     name="blog_showcategory")
     * @return Response A response instance
     */
    public function showByCategory(string $categoryName): Response
    {
        if (!$categoryName) {
            throw $this->createNotFoundException('this category doesn\'nt exists.');
        }
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneByName($categoryName);
        return $this->render(
            'blog/category.html.twig',
            [
                'category' => $category,
            ]);

    }
}
