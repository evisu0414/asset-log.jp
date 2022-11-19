<?php

declare(strict_types=1);

namespace App\UseCases\User;

use App\Models\User;
use App\Services\User\UpdateUserService;
use App\UseCases\UseCaseInterface;

class UpdateUserUseCase implements UseCaseInterface
{
    /**
     * @param UpdateUserService $updateUserService
     */
    public function __construct(private readonly UpdateUserService $updateUserService)
    {
    }

    /**
     * @param array $attributes
     * @param User $user
     *
     * @return void
     */
    public function __invoke(array $attributes, User $user): void
    {
        ($this->updateUserService)($attributes, $user);
    }
}
