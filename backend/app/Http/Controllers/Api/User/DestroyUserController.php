<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\UseCases\User\DeleteUserUseCase;
use Illuminate\Http\JsonResponse;

class DestroyUserController extends Controller
{
    /**
     * @param DeleteUserUseCase $deleteUserUseCase
     */
    public function __construct(private readonly DeleteUserUseCase $deleteUserUseCase)
    {
    }

    public function __invoke(User $user): JsonResponse
    {
        ($this->deleteUserUseCase)($user);

        return $this->noContentJsonResponse();
    }
}
