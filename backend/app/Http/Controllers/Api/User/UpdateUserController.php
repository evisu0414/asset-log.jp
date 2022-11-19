<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\UseCases\User\UpdateUserUseCase;
use Illuminate\Http\JsonResponse;

class UpdateUserController extends Controller
{
    /**
     * @param UpdateUserUseCase $updateUserUseCase
     */
    public function __construct(private readonly UpdateUserUseCase $updateUserUseCase)
    {
    }

    /**
     * @param UpdateUserRequest $request
     * @param User $user
     *
     * @return JsonResponse
     */
    public function __invoke(UpdateUserRequest $request, User $user): JsonResponse
    {
        ($this->updateUserUseCase)($request->only(['name', 'email']), $user);

        return $this->noContentJsonResponse();
    }
}
