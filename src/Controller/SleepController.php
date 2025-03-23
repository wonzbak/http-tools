<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class SleepController extends AbstractController
{
    #[Route('/sleep/{second}', name: 'app_sleep', requirements: ['second'=> '\d+'])]
    public function second(int $second = 1): JsonResponse
    {
        sleep($second);

        return $this->json([
            'sleep' => sprintf('slept for %d second(s)', $second),
        ]);
    }

    #[Route('/sleep-ms/{msecond}', name: 'app_ms_sleep', requirements: ['second'=> '\d+'])]
    public function msSecond(int $msecond = 10): JsonResponse
    {
        $microSecond = $msecond * 1000;
        usleep($microSecond);

        return $this->json([
            'sleep' => sprintf('slept for %d ms', $msecond),
        ]);
    }
}
