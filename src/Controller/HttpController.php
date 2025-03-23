<?php

namespace App\Controller;

use App\Request\RequestDataTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/')]
final class HttpController extends AbstractController
{
    use RequestDataTrait;

    #[Route('/', name: 'app_http')]
    public function index(Request $request): JsonResponse
    {
        return new JsonResponse(['request' => $this->getRequestData($request)]);
    }

    #[Route('/headers', name: 'app_http_headers')]
    public function headers(Request $request): JsonResponse
    {
        return new JsonResponse($request->headers->all());
    }

    #[Route('/user-agent', name: 'app_http_ua')]
    public function userAgent(Request $request): JsonResponse
    {
        return new JsonResponse(['user-agent' => $request->headers->get('user-agent')]);
    }

    #[Route('/ip', name: 'app_http_ip')]
    public function ip(Request $request): JsonResponse
    {
        return new JsonResponse(['ip' => $request->getClientIp()]);
    }


    #[Route('/status/{status}', name: 'app_http_status', requirements: ['driveName' => '\d+'])]
    public function status(int $status, Request $request): JsonResponse
    {
        $requestData = [];
//        if ($request->query->get('debug') === 'true') {
//            $requestData = $this->getRequestData($request);
//        }

        $responseData = [
            'status' => $status,
            'text' => Response::$statusTexts[$status] ?? ''
        ];

        if ($requestData !== []) {
            $responseData['request'] = $requestData;
        }

        return $this->json($responseData, $status);
    }

    #[Route('/redirect', name: 'app_http_redirect')]
    public function redirectTo(Request $request): Response
    {
        $location = $request->query->get('location');
        if ($location === null || $location === '') {
            return $this->json([
                    'status' => Response::HTTP_BAD_REQUEST,
                    'text' => Response::$statusTexts[Response::HTTP_BAD_REQUEST],
                    'details' => 'location query parameter is missing or empty',
                ]
            );
        }

        return new RedirectResponse($location);
    }
}
