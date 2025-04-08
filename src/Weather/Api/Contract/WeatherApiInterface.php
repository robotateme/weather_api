<?php

namespace App\Weather\Api\Contract;

interface WeatherApiInterface
{
    public function forCity(string $city, string $unitType = 'c');
}