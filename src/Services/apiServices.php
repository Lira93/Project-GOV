<?php


namespace App\Services;
use Symfony\Component\HttpClient\HttpClient;

class apiServices
{
    public function getData(){
        $httpClient = HttpClient::create();
        $response = $httpClient->request('GET','http://api.gios.gov.pl/pjp-api/rest/station/findAll');

        $arrResponse = $response->toArray();
        //$json = $var->toArray();
        $tabCities = array();

        foreach ($arrResponse as $station){
            $citiName = $station['city']['name'];
            $stationData = array();
            $stationData['name'] = $citiName;
            $stationData['data'] = $station;
            $tabCities[$station['city']['id']][]= $stationData;

        }
        return $tabCities;
    }
}