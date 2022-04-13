<?php

namespace App\Controller;

use App\Entity\Article;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    private $serializer;

    public function __construct(SerializerInterface $serializerI)
    {
        $this->serializer = $serializerI;
    }
    /**
     * @Route("/articles/{id}", name="article_show")
     */
    public function showAction()
    {
        $article = new Article();
        $article
            ->setTitle('Mon premier article')
            ->setContent('Le contenu de mon article.');

        $data = $this->serializer->serialize($article, 'json');
        
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        // dd($article);

        return $response;
    }
}
