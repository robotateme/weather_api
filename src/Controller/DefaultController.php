<?php

namespace App\Controller;


use App\Dto\WeatherApiRequest\WeatherRequestDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class DefaultController extends AbstractController
{
    #[Route('/api', name: 'home')]
    public function indexAction( ): JsonResponse
    {
        return $this->json(['test' =>  1]);
    }
}
