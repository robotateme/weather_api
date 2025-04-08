<?php

namespace App\Entity;

use App\Repository\ApiResponseRepository;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApiResponseRepository::class)]
class ApiResponse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 5)]
    private ?string $temperatureCelsius = null;

    #[ORM\Column(length: 5)]
    private ?string $temperatureFahrenheit = null;

    #[ORM\Column(length: 5)]
    private ?string $windSpeed = null;

    #[ORM\Column]
    private ?int $userId = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeInterface $datetime = null;

    #[ORM\Column]
    private ?string $weatherConditionText = null;

    #[ORM\Column]
    private ?string $cityName = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTemperatureCelsius(): ?string
    {
        return $this->temperatureCelsius;
    }

    public function setTemperatureCelsius(string $temperature_celsius): static
    {
        $this->temperatureCelsius = $temperature_celsius;

        return $this;
    }

    public function getTemperatureFahrenheit(): ?string
    {
        return $this->temperatureFahrenheit;
    }

    public function setTemperatureFahrenheit(string $temperature_fahrenheit): static
    {
        $this->temperatureFahrenheit = $temperature_fahrenheit;

        return $this;
    }

    public function getWindSpeed(): ?string
    {
        return $this->windSpeed;
    }

    public function setWindSpeed(string $windSpeed): static
    {
        $this->windSpeed = $windSpeed;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): static
    {
        $this->userId = $userId;

        return $this;
    }

    public function getDatetime(): ?DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(DateTimeInterface $datetime): static
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getWeatherConditionText(): ?string
    {
        return $this->weatherConditionText;
    }

    public function setWeatherConditionText(string $weather_condition_text): static
    {
        $this->weatherConditionText = $weather_condition_text;

        return $this;
    }

    public function getCityName(): ?string
    {
        return $this->cityName;
    }

    public function setCityName(string $cityName): static
    {
        $this->cityName = $cityName;

        return $this;
    }
}
