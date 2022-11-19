<?php

declare(strict_types=1);

namespace App\UseCases\User;

use App\Models\User;
use App\Services\User\DeleteUserService;

class DeleteUserUseCase
{
    /**
     * @param DeleteUserService $deleteUserService
     */
    public function __construct(private readonly DeleteUserService $deleteUserService)
    {
    }

    /**
     * @param User $user
     *
     * @return void
     */
    public function __invoke(User $user): void
    {
        ($this->deleteUserService)($user);
    }
}
