<?php

declare(strict_types=1);

namespace App\UseCases\User;

use App\Models\User;
use App\Services\User\CreateUserService;
use App\UseCases\UseCaseInterface;

class CreateUserUseCase implements UseCaseInterface
{
    /**
     * @param CreateUserService $createUserService
     */
    public function __construct(private readonly CreateUserService $createUserService)
    {
    }

    /**
     * @param array $attributes
     *
     * @return User
     */
    public function __invoke(array $attributes): User
    {
        return ($this->createUserService)($attributes);
    }
}
