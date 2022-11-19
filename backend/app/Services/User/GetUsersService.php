<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class GetUsersService
{
    /**
     * @return Collection
     */
    public function __invoke(): Collection
    {
        return User::whereFuneralCompanyId(auth()->user()->funeralCompany->id)->get();
    }
}
