<?php

declare(strict_types=1);

namespace Tests\Feature\Api\User;

use App\Enums\AuthorityType;
use App\Models\User;
use Tests\TestCase;
use Tests\TestUserCreatableTrait;

class DestroyUserControllerTest extends TestCase
{
    use TestUserCreatableTrait;

    /**
     * @var User
     */
    private User $operator;

    /**
     * @var User
     */
    private User $deletableUser;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->operator = $this->createOperator(AuthorityType::Administrator);
        $this->deletableUser = $this->createUsersInSameCompanyAsOperator();
    }

    /**
     * @return void
     */
    public function testDestroy(): void
    {
        $this->actingAs($this->operator);
        $response = $this->deleteJson('/api/users/' . $this->deletableUser->id);

        $response->assertNoContent();
    }
}
