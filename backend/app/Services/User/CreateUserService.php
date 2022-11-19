<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Enums\AuthorityType;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUserService
{
    /**
     * @param array $attributes
     *
     * @return User
     */
    public function __invoke(array $attributes): User
    {
        return User::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => Hash::make($attributes['password']),
            'funeral_company_id' => auth()->user()->funeralCompany->id,
            'authority_type' => AuthorityType::Operator,
        ]);
    }
}
