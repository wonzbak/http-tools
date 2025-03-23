<?php

namespace App\EventSubscriber;

use App\Request\RequestDataTrait;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class DebugRequestSubscriber implements EventSubscriberInterface
{
    use RequestDataTrait;

    public static function getSubscribedEvents(): array
    {
        return [

            KernelEvents::RESPONSE => 'onKernelResponse',
        ];
    }

    public function onKernelResponse(ResponseEvent $event): void
    {
        $request = $event->getRequest();
        $response = $event->getResponse();

        // add request data to response if debug query parameter is true
        if ($request->query->has('debug') && $request->query->get('debug') === "true") {
            $responseData = json_decode($response->getContent(), true);
            $responseData['request'] = $this->getRequestData($request);
            $event->setResponse(new JsonResponse($responseData, $response->getStatusCode()));
        }
    }
}