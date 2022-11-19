<?php

declare(strict_types=1);

namespace Tests\Unit\Requests\User;

use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;
use Tests\TestUserCreatableTrait;

class UpdateUserRequestTest extends TestCase
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
        $this->operator = $this->createOperator();
    }

    /**
     * @dataProvider provideTestValidationCases
     *
     * @param bool $expected
     * @param array $parameters
     *
     * @return void
     */
    public function testValidation(bool $expected, array $parameters): void
    {
        $request = $this->partialMock(UpdateUserRequest::class)
            ->shouldReceive('route')
            ->with('user')
            ->once()
            ->andReturn($this->operator)
            ->getMock();

        $validator = Validator::make($parameters, $request->rules());
        $this->assertSame($expected, $validator->passes());
    }

    /**
     * @return array
     */
    public function provideTestValidationCases(): array
    {
        $this->createApplication();

        return [
            [
                true,
                [
                    'name' => fake()->name(),
                    'email' => fake()->safeEmail(),
                ],
            ],
            [
                false,
                [
                    'name' => null,
                    'email' => fake()->safeEmail(),
                ],
            ],
        ];
    }
}
