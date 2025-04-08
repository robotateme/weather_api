<?php

namespace App\Controller;

use App\Dto\WeatherApiRequest\WeatherRequestDto;
use App\Scenario\SendWeatherRequestScenario;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class WeatherController extends AbstractController
{
    public function __construct(private SendWeatherRequestScenario $scenario)
    {
    }

    #[Route('/api/weather', name: 'app_weather', methods: ['POST'])]
    public function index(#[MapRequestPayload] WeatherRequestDto $dto): JsonResponse
    {
        $dto->userId = $this->getUser()->getId();
        dd($this->scenario->execute($dto));
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/WeatherController.php',
        ]);
    }
}
