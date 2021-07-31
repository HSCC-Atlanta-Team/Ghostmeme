<?php

namespace App\Api;

class GhostmemeApi {
    protected $client;

    protected $requestOptions = []; 

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => $_ENV['API_BASE_URL'],
        ]);

        $this->requestOptions = [
            'http_errors' => false,
            'headers' => [
                'key' => $_ENV['API_KEY'],
                'content-type' => 'application/json',
            ],
        ];
    }

    public function setOption($key, $value)
    {
        $this->requestOptions[$key] = $value;
    }

    public function getOptions()
    {
        return $this->requestOptions;
    }

    public function sendRequest($method, $endpoint)
    {
        $response = $this->client->request($method, $endpoint, $this->getOptions());

        return $response;
    }
}