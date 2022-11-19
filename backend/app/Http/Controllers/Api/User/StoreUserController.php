<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\UseCases\User\CreateUserUseCase;
use Illuminate\Http\JsonResponse;

class StoreUserController extends Controller
{
    /**
     * @param CreateUserUseCase $createUserUseCase
     */
    public function __construct(private readonly CreateUserUseCase $createUserUseCase)
    {
    }

    /**
     * @param StoreUserRequest $request
     *
     * @return JsonResponse
     */
    public function __invoke(StoreUserRequest $request): JsonResponse
    {
        $user = ($this->createUserUseCase)($request->only(['name', 'email', 'password']));

        return $this->createdJsonResponse(['id' => $user->id]);
    }
}
