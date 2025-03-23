<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class ControllerExceptionSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [

            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

    public function onKernelException(ExceptionEvent $event)
    {

        $throwable = $event->getThrowable();

        $response = match (true) {
            $throwable instanceof NotFoundHttpException => new JsonResponse(
                [
                    'status' => Response::HTTP_NOT_FOUND,
                    'text' => Response::$statusTexts[Response::HTTP_NOT_FOUND],
                    'details' => $throwable->getMessage()
                ],
                Response::HTTP_NOT_FOUND
            ),
            default => new JsonResponse(
                [
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'text' => Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR],
                    'details' => $throwable->getMessage()
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            )
        };

        $event->setResponse($response);
    }
}