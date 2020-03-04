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

        $string_start = '';
        $string_end = '';

        if (!empty($request->start)) {
            $date_start = date_create($request->start);
            $string_start = date_format($date_start, 'Y-m-d');
        }

        if (!empty($request->end)) {
            $date_end = date_create($request->end);
            $string_end = date_format($date_end, 'Y-m-d');
        }

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
                'company' => $request->company,
                'relevance' => $request->relevance,
                'start' => $string_start,
                'end' => $string_end,
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

        $string_start = '';
        $string_end = '';

        if (!empty($request->start)) {
            $date_start = date_create($request->start);
            $string_start = date_format($date_start, 'Y-m-d');
        }

        if (!empty($request->end)) {
            $date_end = date_create($request->end);
            $string_end = date_format($date_end, 'Y-m-d');
        }

        $return = null;
        $client = new Client([
            'base_uri' => $base_uri
        ]);

        $response = $client->request('POST', "/api/contact-download", [
            'http_errors' => false,
            'headers' => [
              'X-API-KEY' => $apiKey
            ],
            'json' => [
                //'company' => $request->company,
                //'relevance' => $request->relevance,
                'start' => $string_start,
                'end' => $string_end,
            ]
        ]);

        $return['data'] = '';

        if ($response->getStatusCode() == 200) {
            $return['data'] = (string)$response->getBody();
        }

        $return['status'] = $response->getStatusCode();

        return $return;
    }
}
