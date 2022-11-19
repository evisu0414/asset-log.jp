<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Models\User;

class DeleteUserService
{
    /**
     * @param User $user
     *
     * @return bool
     */
    public function __invoke(User $user): bool
    {
        return $user->delete();
    }
}
