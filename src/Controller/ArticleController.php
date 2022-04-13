<?php

namespace App\Controller;

use App\Entity\Article;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    // this property is initialized here to be filled once the construct will be called 
    private $serializer;
    private $deserializer;

    public function __construct(SerializerInterface $serializerI)
    {
        $this->serializer = $serializerI;
        $this->deserializer = $serializerI;
    }

    /**
     * Gets data that we set here for a SERIALIZE TEST
     * 
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

    /**
     * Creates content that will be sent from user to API with POST method
     * 
     * @Route("/articles", name="article_create", methods={"GET","POST"})
     * 
     */
    public function createAction(Request $request)
    {
        // retrieve http request data thanks to the method getContent calleb by Request object injected as parameters
        $data = $request->getContent();
        
        // method get from Abstract controller allows to contain a service that can be injected, autowired
        // Among the methods provided by Serializer we have the deserialize
        $article = $this->deserializer->deserialize($data, 'App\Entity\Article', 'json');

        // $em as Entity Manager is the service which provides methods to save data and send to database by using the ORM Doctrine
        // We calll the manager first
        $em = $this->getDoctrine()->getManager();

        // Persisting is preparing for the saving
        $em->persist($article);

        // Flush send the saved data to database
        $em->flush();

        // HTTP_CREATED is the constant for code 201 displayed when response is well loaded on the user page
        return new Response('', Response::HTTP_CREATED);
    }
}
