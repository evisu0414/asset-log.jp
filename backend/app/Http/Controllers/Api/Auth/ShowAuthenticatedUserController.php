<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class ShowAuthenticatedUserController extends Controller
{
    /**
     * @param Request $request
     *
     * @return UserResource
     */
    public function __invoke(Request $request): UserResource
    {
        return new UserResource($request->user());
    }
}
