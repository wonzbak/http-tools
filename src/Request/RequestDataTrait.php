<?php

namespace App\Request;

use Symfony\Component\HttpFoundation\Request;

trait RequestDataTrait
{
    private function getRequestData(Request $request): array
    {
        return [
            'ip' => $request->getClientIp(),
            'headers' => $request->headers->all(),
            'method' => $request->getMethod(),
            'scheme' => $request->getScheme(),
            'host' => $request->getHttpHost(),
            'port' => $request->getPort(),
            'path' => $request->getPathInfo(),
            'query' => $request->query->all(),
        ];
    }
}