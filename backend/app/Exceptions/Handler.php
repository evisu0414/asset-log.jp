<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * @var array<class-string<Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
    ];

    /**
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
    ];

    /**
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * @return void
     */
    public function register(): void
    {
        $this->renderable(function (Throwable $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json(
                    ['errors' => [$e->getMessage()]],
                    method_exists($e, 'getStatusCode')
                        ? $e->getStatusCode()
                        : Response::HTTP_INTERNAL_SERVER_ERROR
                );
            }
        });
    }
}
