<?php

declare(strict_types=1);

namespace Tests\Unit\Services\User;

use App\Models\User;
use App\Services\User\UpdateUserService;
use Tests\TestCase;
use Tests\TestUserCreatableTrait;

class UpdateUserServiceTest extends TestCase
{
    use TestUserCreatableTrait;

    /**
     * @var User
     */
    private User $updatableUser;

    /**
     * @var UpdateUserService
     */
    private UpdateUserService $service;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->updatableUser = $this->createUsersInSameCompanyAsOperator();
        $this->service = new UpdateUserService();
    }

    /**
     * @dataProvider provideTestUpdateCases
     *
     * @param array $attributes
     *
     * @return void
     */
    public function testUpdate(array $attributes): void
    {
        $this->assertTrue(($this->service)($attributes, $this->updatableUser));
        $this->assertDatabaseHas('users', [
            'name' => $attributes['name'],
            'email' => $attributes['email'],
        ]);
    }

    /**
     * @return array
     */
    public function provideTestUpdateCases(): array
    {
        return [
            [
                [
                    'name' => fake()->name(),
                    'email' => fake()->safeEmail(),
                ],
            ],
        ];
    }
}
