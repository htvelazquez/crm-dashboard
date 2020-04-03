<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DirectoryController extends Controller
{
    public function index()
    {
        return view('directory.index');
    }

    public function status()
    {
        $base_uri = getenv('LEADGENJOBS_URL');
        $apiKey = getenv('LEADGENJOBS_X-API-KEY');

        $return = null;
        $client = new Client([
            'base_uri' => $base_uri
        ]);

        $response = $client->request('GET', "/api/v1/ping", [
            'http_errors' => false,
            'headers' => [
              'X-API-KEY' => $apiKey
            ]
        ]);

        $return['data'] = [];

        if ($response->getStatusCode() == 200) {
            $return['data'] = json_decode((string)$response->getBody());
        }

        $return['status'] = $response->getStatusCode();

        return $return;
    }

    public function contacts(Request $request)
    {
        $base_uri = getenv('DIRECTORY_URL');
        $apiKey = getenv('DIRECTORY_X-API-KEY');

        $return = null;
        $client = new Client([
            'base_uri' => $base_uri
        ]);

        $response = $client->request('GET', "/api/contacts", [
            'http_errors' => false,
            'headers' => [
              'X-API-KEY' => $apiKey
            ],
            'query' => [
                'page'  => $request->page,
                'limit' => $request->limit,
                'title' => $request->title,
                'tags' => (!empty($request->tags))? implode(',',$request->tags) : '',
                'language' => $request->language,
                'location' => $request->location
            ]
        ]);

        $return['data'] = [];

        if ($response->getStatusCode() == 200) {
            $return['data'] = json_decode((string)$response->getBody());
        }

        $return['status'] = $response->getStatusCode();

        return $return;
    }

    public function CSVcontacts(Request $request)
    {
        $base_uri = getenv('DIRECTORY_URL');
        $apiKey = getenv('DIRECTORY_X-API-KEY');

        $return = null;
        $client = new Client([
            'base_uri' => $base_uri
        ]);

        $response = $client->request('GET', "/api/contacts-download", [
            'http_errors' => false,
            'headers' => [
              'X-API-KEY' => $apiKey
            ],
            'query' => [
                'title' => $request->title,
                'tags' => (!empty($request->tags))? implode(',',$request->tags) : '',
                'language' => $request->language,
                'location' => $request->location
            ]
        ]);

        $return['data'] = '';

        if ($response->getStatusCode() == 200) {
            $return['data'] = (string)$response->getBody();
        }

        $return['status'] = $response->getStatusCode();

        return $return;
    }

    public function getLabels(Request $request)
    {
        $base_uri = getenv('DIRECTORY_URL');
        $apiKey = getenv('DIRECTORY_X-API-KEY');

        $client = new Client([
            'base_uri' => $base_uri
        ]);

        $response = $client->request('GET', "/api/labels", [
            'http_errors' => false,
            'headers' => [
              'X-API-KEY' => $apiKey
            ],
            'query' => [
              'term'  => $request->term
            ]
        ]);

        $return = [];

        if ($response->getStatusCode() == 200) {
            $labels = json_decode((string)$response->getBody());
            if (!empty($labels->suggestions))
                $return = $labels->suggestions;
        }

        return $return;
    }
}
