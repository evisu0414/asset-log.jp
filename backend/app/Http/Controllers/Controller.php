<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    /**
     * @param array $data
     *
     * @return JsonResponse
     */
    protected function createdJsonResponse(array $data): JsonResponse
    {
        return response()->json($data, Response::HTTP_CREATED);
    }

    /**
     * @return JsonResponse
     */
    protected function noContentJsonResponse(): JsonResponse
    {
        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    /**
     * @param array $errors
     *
     * @return JsonResponse
     */
    protected function unAuthorizedJsonResponse(array $errors): JsonResponse
    {
        return response()->json(['errors' => $errors], Response::HTTP_UNAUTHORIZED);
    }
}
