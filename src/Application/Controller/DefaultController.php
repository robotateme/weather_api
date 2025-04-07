<?php

namespace Source\Application\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController
{
    #[Route('/', name: 'home')]
    public function indexAction(): JsonResponse
    {
        return new JsonResponse(['Hello World!']);
    }
}
