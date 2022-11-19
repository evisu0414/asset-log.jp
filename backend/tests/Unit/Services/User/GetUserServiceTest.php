<?php

declare(strict_types=1);

namespace Tests\Unit\Services\User;

use App\Services\User\GetUsersService;
use Tests\TestCase;
use Tests\TestUserCreatableTrait;

class GetUserServiceTest extends TestCase
{
    use TestUserCreatableTrait;

    /**
     * @var GetUsersService
     */
    private GetUsersService $service;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs($this->createOperator());
        $this->createUsersInSameCompanyAsOperator(3);
        $this->service = new GetUsersService();
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $users = ($this->service)();
        $this->assertCount(4, $users);
    }
}
