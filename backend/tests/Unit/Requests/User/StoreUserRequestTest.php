<?php

declare(strict_types=1);

namespace Tests\Unit\Requests\User;

use App\Http\Requests\User\StoreUserRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class StoreUserRequestTest extends TestCase
{
    /**
     * @var array
     */
    private array $rules;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->rules = (new StoreUserRequest())->rules();
    }

    /**
     * @dataProvider provideTestValidationCases
     *
     * @param bool $expected
     * @param array $request
     *
     * @return void
     */
    public function testValidation(bool $expected, array $request): void
    {
        $validator = Validator::make($request, $this->rules);
        $this->assertSame($expected, $validator->passes());
    }

    /**
     * @return array
     */
    public function provideTestValidationCases(): array
    {
        $this->createApplication();
        $password = fake()->password();

        return [
            [
                true,
                [
                    'name' => fake()->name(),
                    'email' => fake()->safeEmail(),
                    'password' => $password,
                    'password_confirmation' => $password,
                ],
            ],
            [
                false,
                [
                    'name' => null,
                    'email' => fake()->safeEmail(),
                    'password' => $password,
                    'password_confirmation' => $password,
                ],
            ],
        ];
    }
}
