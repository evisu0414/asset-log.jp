<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{
    /**
     * @param Request $request
     */
    protected function redirectTo($request): JsonResponse|string|null
    {
        return $request->expectsJson()
            ? response()->json(['message' => 'Unauthenticated.'], Response::HTTP_UNAUTHORIZED)
            : route('login');
    }
}
