<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiCityController extends AbstractController
{
    /**
     * @Route("/api/city", name="api_city")
     */
    public function index(HttpClientInterface $httpClient)
    {
        $response = $httpClient->request('GET','http://api.gios.gov.pl/pjp-api/rest/station/findAll');

        $var1 = $response->toArray();
        //$json = $var->toArray();


        return $this->render('api_city/index.html.twig', [
            'controller_name' => 'ApiCityController',
            'cities' => $response->toArray(),
        ]);
    }
    /**
     * @Route("/api/city/show/{id}", name="show")
     */
    public function show($id, HttpClientInterface $httpClient)
    {
        $response = $httpClient->request('GET','http://api.gios.gov.pl/pjp-api/rest/station/sensors/'.$id);

        $var = $response->toArray();


        return $this->render('api_city/show.html.twig', [
            'controller_name' => 'ApiCityController',
            'stations' => $response->toArray(),
        ]);

    }
}
