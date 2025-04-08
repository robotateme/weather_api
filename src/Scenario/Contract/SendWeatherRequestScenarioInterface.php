<?php

namespace App\Scenario\Contract;

use App\Dto\WeatherApiRequest\Contract\DtoInterface;

interface SendWeatherRequestScenarioInterface extends ScenarioInterface
{
    public function execute(DtoInterface $weatherRequestDto);
}