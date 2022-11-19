<?php

declare(strict_types=1);

namespace Tests\Unit\Services\User;

use App\Models\User;
use App\Services\User\DeleteUserService;
use Tests\TestCase;
use Tests\TestUserCreatableTrait;

class DeleteUserServiceTest extends TestCase
{
    use TestUserCreatableTrait;

    /**
     * @var User
     */
    private User $deletableUser;

    /**
     * @var DeleteUserService
     */
    private DeleteUserService $service;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->createOperator();
        $this->deletableUser = $this->createUsersInSameCompanyAsOperator();
        $this->service = new DeleteUserService();
    }

    /**
     * @return void
     */
    public function testDelete(): void
    {
        $this->assertTrue(($this->service)($this->deletableUser));
        $this->assertSoftDeleted('users', ['id' => $this->deletableUser->id]);
    }
}
