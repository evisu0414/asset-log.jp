<?php

declare(strict_types=1);

namespace Tests\Feature\Api\User;

use App\Enums\AuthorityType;
use App\Models\User;
use Tests\TestCase;
use Tests\TestUserCreatableTrait;

class IndexUserControllerTest extends TestCase
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
        $this->createUsersInSameCompanyAsOperator(3);
    }

    /**
     * @return void
     */
    public function testIndex(): void
    {
        $this->actingAs($this->operator);
        $response = $this->getJson('/api/users');

        $response->assertOk();
        $this->assertCount(4, $response->json('data'));
    }
}
