<?php

declare(strict_types=1);

namespace Tests\Feature\Api\User;

use App\Enums\AuthorityType;
use App\Models\User;
use Tests\TestCase;
use Tests\TestUserCreatableTrait;

class UpdateUserControllerTest extends TestCase
{
    use TestUserCreatableTrait;

    /**
     * @var User
     */
    private User $operator;

    /**
     * @var User
     */
    private User $updatableUser;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->operator = $this->createOperator(AuthorityType::Administrator);
        $this->updatableUser = $this->createUsersInSameCompanyAsOperator();
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->actingAs($this->operator);
        $response = $this->putJson(
            '/api/users/' . $this->updatableUser->id,
            [
                'name' => 'テスト氏名更新',
                'email' => 'update_user_controller@example.com',
            ],
            [
                'Content-Type' => 'application/json',
            ]
        );

        $response->assertNoContent();
    }
}
