<?php

namespace App\Dto\WeatherApiRequest;

use App\Dto\WeatherApiRequest\Contract\DtoInterface;
use DateTimeInterface;

class WeatherRequestResultDto implements DtoInterface
{
    public function __construct(
        public ?string            $temperatureCelsius = null,
        public ?string            $temperatureFahrenheit = null,
        public ?string            $windSpeed = null,
        public ?string            $weatherConditionText = null,
        public ?string            $cityName = null,
        public ?DateTimeInterface $dateTime = null,
    )
    {
    }
}