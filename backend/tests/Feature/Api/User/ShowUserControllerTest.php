<?php

declare(strict_types=1);

namespace Tests\Feature\Api\User;

use App\Enums\AuthorityType;
use App\Models\User;
use Tests\TestCase;
use Tests\TestUserCreatableTrait;

class ShowUserControllerTest extends TestCase
{
    use TestUserCreatableTrait;

    /**
     * @var User
     */
    private User $operator;

    /**
     * @var User
     */
    private User $viewableUser;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->operator = $this->createOperator(AuthorityType::Administrator);
        $this->viewableUser = $this->createUsersInSameCompanyAsOperator();
    }

    /**
     * @return void
     */
    public function testShow(): void
    {
        $this->actingAs($this->operator);
        $response = $this->getJson('/api/users/' . $this->viewableUser->id);

        $response->assertOk();
        $this->assertNotEmpty($response->json('data'));
    }
}
