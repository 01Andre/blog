<?php
// src/Controller/BlogController.php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog_index")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig', [
                'owner' => 'André',]
        );
    }

    /**
     * @route("/blog/show/{slug}", name="blog_show", requirements={"slug"="[a-z0-9\-]+"})
     */
    public function show($slug="Article Sans Titre")
    {
        $slug= str_replace('-',' ', $slug);
        $slug = ucwords($slug);
        return $this->render('blog/show.html.twig', ['slug' => $slug]);
    }
}
