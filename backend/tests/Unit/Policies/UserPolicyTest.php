<?php

declare(strict_types=1);

namespace Tests\Unit\Policies;

use App\Enums\AuthorityType;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;
use Tests\TestUserCreatableTrait;

class UserPolicyTest extends TestCase
{
    use TestUserCreatableTrait;

    /**
     * @dataProvider provideTestCreateCases
     *
     * @param bool $expected
     * @param AuthorityType $authorityType
     *
     * @return void
     */
    public function testCreate(bool $expected, AuthorityType $authorityType): void
    {
        $operator = $this->createOperator($authorityType);
        $this->assertSame($expected, Gate::forUser($operator)->allows('create', User::class));
    }

    /**
     * @return array
     */
    public function provideTestCreateCases(): array
    {
        return [
            [false, AuthorityType::Operator],
            [true, AuthorityType::Administrator],
            [false, AuthorityType::UniquestAdministrator],
            [false, AuthorityType::System],
        ];
    }

    /**
     * @dataProvider provideTestViewUserInSameCompanyAsOperatorCases
     *
     * @param bool $expected
     * @param AuthorityType $authorityType
     *
     * @return void
     */
    public function testViewUserInSameCompanyAsOperator(bool $expected, AuthorityType $authorityType): void
    {
        $operator = $this->createOperator($authorityType);
        $targetUser = $this->createUsersInSameCompanyAsOperator();
        $this->assertSame($expected, Gate::forUser($operator)->allows('view', $targetUser));
    }

    /**
     * @return array
     */
    public function provideTestViewUserInSameCompanyAsOperatorCases(): array
    {
        return [
            [true, AuthorityType::Operator],
            [true, AuthorityType::Administrator],
            [true, AuthorityType::UniquestAdministrator],
            [true, AuthorityType::System],
        ];
    }

    /**
     * @dataProvider provideTestViewUserInDifferentCompanyFromOperatorCases
     *
     * @param bool $expected
     * @param AuthorityType $authorityType
     *
     * @return void
     */
    public function testViewUserInDifferentCompanyFromOperator(bool $expected, AuthorityType $authorityType): void
    {
        $operator = $this->createOperator($authorityType);
        $targetUser = $this->createUsersInDifferentCompanyFromOperator();
        $this->assertSame($expected, Gate::forUser($operator)->allows('view', $targetUser));
    }

    /**
     * @return array
     */
    public function provideTestViewUserInDifferentCompanyFromOperatorCases(): array
    {
        return [
            [false, AuthorityType::Operator],
            [false, AuthorityType::Administrator],
            [false, AuthorityType::UniquestAdministrator],
            [false, AuthorityType::System],
        ];
    }

    /**
     * @dataProvider provideTestUpdateByThemselvesCases
     *
     * @param bool $expected
     * @param AuthorityType $authorityType
     *
     * @return void
     */
    public function testUpdateByThemselves(bool $expected, AuthorityType $authorityType): void
    {
        $operator = $this->createOperator($authorityType);
        $this->assertSame($expected, Gate::forUser($operator)->allows('update', $operator));
    }

    /**
     * @return array
     */
    public function provideTestUpdateByThemselvesCases(): array
    {
        return [
            [true, AuthorityType::Operator],
            [true, AuthorityType::Administrator],
            [true, AuthorityType::UniquestAdministrator],
            [true, AuthorityType::System],
        ];
    }

    /**
     * @dataProvider provideTestUpdateInSameCompanyAsOperatorCases
     *
     * @param bool $expected
     * @param AuthorityType $authorityType
     *
     * @return void
     */
    public function testUpdateUserInSameCompanyAsOperator(bool $expected, AuthorityType $authorityType): void
    {
        $operator = $this->createOperator($authorityType);
        $targetUser = $this->createUsersInSameCompanyAsOperator();
        $this->assertSame($expected, Gate::forUser($operator)->allows('update', $targetUser));
    }

    /**
     * @return array
     */
    public function provideTestUpdateInSameCompanyAsOperatorCases(): array
    {
        return [
            [false, AuthorityType::Operator],
            [true, AuthorityType::Administrator],
            [false, AuthorityType::UniquestAdministrator],
            [false, AuthorityType::System],
        ];
    }

    /**
     * @dataProvider provideTestUpdateInDifferentCompanyFromOperatorCases
     *
     * @param bool $expected
     * @param AuthorityType $authorityType
     *
     * @return void
     */
    public function testUpdateUserInDifferentCompanyFromOperator(bool $expected, AuthorityType $authorityType): void
    {
        $operator = $this->createOperator($authorityType);
        $targetUser = $this->createUsersInDifferentCompanyFromOperator();
        $this->assertSame($expected, Gate::forUser($operator)->allows('update', $targetUser));
    }

    /**
     * @return array
     */
    public function provideTestUpdateInDifferentCompanyFromOperatorCases(): array
    {
        return [
            [false, AuthorityType::Operator],
            [false, AuthorityType::Administrator],
            [false, AuthorityType::UniquestAdministrator],
            [false, AuthorityType::System],
        ];
    }
}
