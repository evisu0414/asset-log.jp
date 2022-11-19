<?php

declare(strict_types=1);

namespace Tests\Unit\Services\User;

use App\Services\User\CreateUserService;
use Tests\TestCase;
use Tests\TestUserCreatableTrait;

class CreateUserServiceTest extends TestCase
{
    use TestUserCreatableTrait;

    /**
     * @var CreateUserService
     */
    private CreateUserService $service;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs($this->createOperator());
        $this->service = new CreateUserService();
    }

    /**
     * @dataProvider provideTestCreateCases
     *
     * @param array $attributes
     *
     * @return void
     */
    public function testCreate(array $attributes): void
    {
        $user = ($this->service)($attributes);

        $this->assertModelExists($user);
    }

    /**
     * @return array
     */
    public function provideTestCreateCases(): array
    {
        return [
            [
                [
                    'name' => fake()->name(),
                    'email' => fake()->safeEmail(),
                    'password' => fake()->password(),
                ],
            ],
        ];
    }
}
