<?php

namespace App\Weather\Api;

use App\Weather\Api\Contract\WeatherApiInterface;
use SensitiveParameter;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class WeatherApi implements WeatherApiInterface
{

    public function __construct(
        private HttpClientInterface $client,
        #[SensitiveParameter]
        #[Autowire(env: 'WEATHER_API_KEY')]
        private string $apiKey
    )
    {
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function forCity(string $city, string $unitType = 'c'): ResponseInterface
    {
        $response = $this->client->request('GET', 'http://api.weatherapi.com/v1/current.json',
            ['query' => ['q' => $city, 'key' => $this->apiKey, 'aqi' => 'no']]
        );

        return $response;
    }
}