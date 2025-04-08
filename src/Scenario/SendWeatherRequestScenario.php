<?php

namespace App\Scenario;

use App\Dto\WeatherApiRequest\Contract\DtoInterface;
use App\Dto\WeatherApiRequest\WeatherRequestDto;
use App\Dto\WeatherApiRequest\WeatherRequestResultDto;
use App\Entity\ApiResponse;
use App\Repository\ApiResponseRepository;
use App\Scenario\Contract\SendWeatherRequestScenarioInterface;
use App\Weather\Api\WeatherApi;
use DateTime;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\VarExporter\Hydrator;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;

class SendWeatherRequestScenario implements SendWeatherRequestScenarioInterface
{
    public function __construct(
        private ApiResponseRepository $apiResponseRepository,
        private WeatherApi $weatherApi
    )
    {

    }

    /**
     * @param WeatherRequestDto $weatherRequestDto
     * @return DtoInterface
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function execute(DtoInterface $weatherRequestDto): DtoInterface
    {
        $apiResponseEntity = new ApiResponse();

        $response = $this->weatherApi->forCity($weatherRequestDto->cityName);

        $apiResponseEntity->setTemperatureCelsius($resultDto->temperatureCelsius)
            ->setTemperatureFahrenheit($resultDto->temperatureFahrenheit)
            ->setWindSpeed($resultDto->windSpeed)
            ->setWeatherConditionText($resultDto->weatherConditionText)
            ->setDatetime($resultDto->dateTime)
            ->setCityName($resultDto->cityName)
            ->setUserId($weatherRequestDto->userId);

        $this->apiResponseRepository->create($apiResponseEntity);

        return $resultDto;

    }

    private function hydrateResultDto($response)
    {
        $accessor = PropertyAccess::createPropertyAccessor();
        $resultDto = new WeatherRequestResultDto();
        $content = $response->toArray();

        return Hydrator::hydrate($resultDto, [
            'temperatureCelsius' => $accessor->getValue($content, '[current][temp_c]'),
            'temperatureFahrenheit' => $accessor->getValue($content, '[current][temp_f]'),
            'windSpeed' => $accessor->getValue($content, '[current][wind_kph]'),
            'weatherConditionText' => $accessor->getValue($content, '[current][condition][text]'),
            'cityName' => $accessor->getValue($content, '[location][name]'),
            'dateTime' => new DateTime(),
        ]);
    }
}