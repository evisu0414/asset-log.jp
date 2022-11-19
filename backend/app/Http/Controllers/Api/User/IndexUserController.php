<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\UseCases\User\GetUsersUseCase;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndexUserController extends Controller
{
    /**
     * @param GetUsersUseCase $getUsersUseCase
     */
    public function __construct(private readonly GetUsersUseCase $getUsersUseCase)
    {
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function __invoke(): AnonymousResourceCollection
    {
        $users = ($this->getUsersUseCase)();

        return UserResource::collection($users);
    }
}
