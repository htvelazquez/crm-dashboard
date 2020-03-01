<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ServicesInventoryController extends Controller
{
    private $base_uri = '';
    private $apiKey = '';

    public function __construct()
    {
        $this->base_uri = getenv('SERVICESINVENTORY_URL');
        $this->apiKey = getenv('SERVICESINVENTORY_X-API-KEY');
    }

    public function getInawareStats()
    {
        $return = null;

        $client = new Client([
            'base_uri' => $this->base_uri
        ]);

        $response = $client->request('GET', "/inaware/stats/all", [
            'http_errors' => false,
            'headers' => [
              'X-API-KEY' => $this->apiKey
            ]
        ]);

        $return['data'] = [];

        if ($response->getStatusCode() == 200) {
            $return['data'] = json_decode((string)$response->getBody());
        }

        $return['status'] = $response->getStatusCode();

        return $return;
    }

}
