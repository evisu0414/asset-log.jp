<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Auth;

use App\Enums\AuthorityType;
use App\Models\User;
use Tests\TestCase;
use Tests\TestUserCreatableTrait;

class ShowAuthenticatedUserControllerTest extends TestCase
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
    public function testShow(): void
    {
        $this->actingAs($this->operator);
        $response = $this->getJson('/api/user');

        $response->assertOk();
        $this->assertNotEmpty($response->json('data'));
    }
}
