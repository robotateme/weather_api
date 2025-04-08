<?php

namespace App\Dto\WeatherApiRequest;

use App\Dto\WeatherApiRequest\Contract\DtoInterface;
use App\Enums\TemperatureUnitTypesEnum;
use Symfony\Component\Validator\Constraints as Assert;

class WeatherRequestDto implements DtoInterface
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Choice([
            TemperatureUnitTypesEnum::UnitCelsius->value,
            TemperatureUnitTypesEnum::UnitFahrenheit->value
        ])]
        public readonly string $unitType,
        #[Assert\NotBlank]
        #[Assert\Type('string')]
        public readonly string $cityName,

        #[Assert\Type('integer')]
        public ?int $userId,
    )
    {
    }
}