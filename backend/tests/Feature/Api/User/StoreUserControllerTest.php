<?php

declare(strict_types=1);

namespace Tests\Feature\Api\User;

use App\Enums\AuthorityType;
use App\Models\User;
use Tests\TestCase;
use Tests\TestUserCreatableTrait;

class StoreUserControllerTest extends TestCase
{
    use TestUserCreatableTrait;

    /**
     * @var User
     */
    private User $operator;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->operator = $this->createOperator(AuthorityType::Administrator);
    }

    /**
     * @return void
     */
    public function testStore(): void
    {
        $this->actingAs($this->operator);
        $response = $this->postJson(
            '/api/users',
            [
                'name' => 'テスト氏名',
                'email' => 'store_user_controller@example.com',
                'password' => 'password',
                'password_confirmation' => 'password',
            ],
            [
                'Content-Type' => 'application/json',
            ]
        );

        $response->assertCreated();

        $this->assertNotEmpty($response->json('id'));
    }
}
