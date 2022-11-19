<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Models\User;

class UpdateUserService
{
    /**
     * @param array $attributes
     * @param User $user
     *
     * @return bool
     */
    public function __invoke(array $attributes, User $user): bool
    {
        return $user->fill($attributes)->save();
    }
}
