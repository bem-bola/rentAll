<?php

// src/Service/NominatimService.php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class HttpClientService
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function request(string $url, array $headers = [], string $method = 'GET', array $options = []): array{
        $response = $this->httpClient->request($method, $url, [
            'headers' => $headers,
        ]);

        return $response->toArray();
    }

    /**
     * Obtenir les coordonnées d'une ville avec Nominatim
     */
    public function getCoordinates(string $city): ?array
    {
        $url = sprintf('https://nominatim.openstreetmap.org/search?q=%s&format=json&addressdetails=1&limit=1', urlencode($city)
        );

        $headers = ['User-Agent' => 'YourAppName/1.0 (your_email@example.com)'];

        $data = $this->request($url, $headers);


        if (!empty($data)) {
            return [
                'lat' => $data[0]['lat'],
                'lon' => $data[0]['lon'],
            ];
        }

        return null;
    }
}


