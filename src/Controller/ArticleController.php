<?php

namespace App\Controller;

use App\Entity\Article;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    // this property is initialized here to be filled once the construct will be called 
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
        // Article entity provides the setters to create content for each property we added
        $article = new Article();
        $article
            ->setTitle('Mon premier article')
            ->setContent('Le contenu de mon article.');

        // serializer private property is called here so we can now use its methods as SerializerInterface is injected as service
        $data = $this->serializer->serialize($article, 'json');
        
        // Response object allows to set the headers content 
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        // dd($article);

        return $response;
    }
}
