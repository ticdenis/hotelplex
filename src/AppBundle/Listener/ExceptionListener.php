<?php

declare(strict_types=1);

namespace App\Listener;

use HotelPlex\Domain\Exception\DomainException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

final class ExceptionListener
{
    /**
     * @param DomainException $exception
     * @return JsonResponse
     */
    public static function domainDefaultJsonResponse(DomainException $exception)
    {
        return new JsonResponse(
            ['error' => $exception->getMessage()],
            $exception->getCode()
        );
    }

    /**
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if ($exception instanceof DomainException) {
            $event->setResponse(self::domainDefaultJsonResponse($exception));
        } else if (getenv('APP_ENV') === 'prod') {
            $event->setResponse(new Response(
                    'Server error',
                    Response::HTTP_INTERNAL_SERVER_ERROR
                )
            );
        }
    }
}
