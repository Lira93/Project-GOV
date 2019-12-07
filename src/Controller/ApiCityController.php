<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Services\apiServices;

class ApiCityController extends AbstractController
{
    /**
     * @Route("/api/city", name="api_city")
     */
    public function index(apiServices $apiServices)
    {
        $data = $apiServices->getData();

        return $this->render('api_city/index.html.twig', [
            'controller_name' => 'ApiCityController',
            'cities' => $data,
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
    /**
     * @Route("/api/city/{id}", name="stations")
     */
    public function stations($id, apiServices $apiServices)
    {

        $data = $apiServices->getData();

        return $this->render('api_city/stations.html.twig', [
            'controller_name' => 'ApiCityController',
            'data' => $data,
            'id' => $id,
        ]);

    }
}
