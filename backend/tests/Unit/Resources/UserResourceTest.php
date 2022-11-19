<?php

declare(strict_types=1);

namespace Tests\Unit\Resources;

use App\Enums\AuthorityType;
use App\Http\Resources\UserResource;
use App\Models\User;
use Tests\TestCase;

class UserResourceTest extends TestCase
{
    /**
     * @return void
     */
    public function testResource(): void
    {
        $user = User::factory()->create([
            'name' => 'テストユーザー',
            'email' => 'user_resource_test@example.com',
            'authority_type' => AuthorityType::Operator,
        ]);

        $resource = new UserResource($user);

        $this->assertSame(
            [
                'id' => $user->id,
                'name' => 'テストユーザー',
                'email' => 'user_resource_test@example.com',
                'authorityType' => [
                    'value' => AuthorityType::Operator->value,
                    'description' => AuthorityType::Operator->description(),
                ],
            ],
            collect($resource->resolve())->except(['funeralCompany'])->toArray()
        );
    }
}
