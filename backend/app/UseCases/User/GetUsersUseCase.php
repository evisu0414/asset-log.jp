<?php

declare(strict_types=1);

namespace App\UseCases\User;

use App\Services\User\GetUsersService;
use App\UseCases\UseCaseInterface;
use Illuminate\Database\Eloquent\Collection;

class GetUsersUseCase implements UseCaseInterface
{
    /**
     * @param GetUsersService $getUsersService
     */
    public function __construct(private readonly GetUsersService $getUsersService)
    {
    }

    /**
     * @return Collection
     */
    public function __invoke(): Collection
    {
        return ($this->getUsersService)();
    }
}
