<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class ShowUserController extends Controller
{
    /**
     * @param User $user
     *
     * @return UserResource|JsonResponse
     */
    public function __invoke(User $user): UserResource|JsonResponse
    {
        return new UserResource($user);
    }
}
