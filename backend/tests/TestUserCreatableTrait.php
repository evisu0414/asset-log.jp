<?php

declare(strict_types=1);

namespace Tests;

use App\Enums\AuthorityType;
use App\Models\FuneralCompany;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

trait TestUserCreatableTrait
{
    /**
     * @param AuthorityType $authorityType
     *
     * @return User
     */
    public function createOperator(AuthorityType $authorityType = AuthorityType::Operator): User
    {
        $funeralCompanies = FuneralCompany::where(
            'squid_id',
            config('squid.test_user_funeral_company_squid_id')
        )->get();

        $funeralCompany = \count($funeralCompanies) > 0
            ? $funeralCompanies[0]
            : FuneralCompany::factory()->create([
                'squid_id' => config('squid.test_user_funeral_company_squid_id'),
            ]);

        return User::factory()->for($funeralCompany)->create([
            'authority_type' => $authorityType,
        ]);
    }

    /**
     * @param int $count
     *
     * @return User|Collection
     */
    public function createUsersInSameCompanyAsOperator(int $count = 1): User|Collection
    {
        $sameCompaniesAsOperator = FuneralCompany::where(
            'squid_id',
            config('squid.test_user_funeral_company_squid_id')
        )->get();

        $sameCompanyAsOperator = \count($sameCompaniesAsOperator) > 0
            ? $sameCompaniesAsOperator[0]
            : FuneralCompany::factory()->create([
                'squid_id' => config('squid.test_user_funeral_company_squid_id'),
            ]);

        return 1 === $count
            ? User::factory()->for($sameCompanyAsOperator)->create()
            : User::factory()->for($sameCompanyAsOperator)->count($count)->create();
    }

    /**
     * @param int $count
     *
     * @return User|Collection
     */
    public function createUsersInDifferentCompanyFromOperator(int $count = 1): User|Collection
    {
        $differentCompaniesFromOperator = FuneralCompany::where(
            'squid_id',
            config('squid.other_test_user_funeral_company_squid_id')
        )->get();

        $differentCompanyFromOperator = \count($differentCompaniesFromOperator) > 0
            ? $differentCompaniesFromOperator[0]
            : FuneralCompany::factory()->create([
                'squid_id' => config('squid.other_test_user_funeral_company_squid_id'),
            ]);

        return 1 === $count
            ? User::factory()->for($differentCompanyFromOperator)->create()
            : User::factory()->for($differentCompanyFromOperator)->count($count)->create();
    }
}
