<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\AuthorityType;
use App\Models\FuneralCompany;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        $this->createSquidUser();
        $this->createUniquestAdministrator();
        $this->createTestUser();
        $this->createDummyCompanyUsers();
    }

    /**
     * @return void
     */
    private function createSquidUser(): void
    {
        $squidUser = User::factory()->create([
            'name' => 'squid',
            'email' => 'squid@example.com',
            'authority_type' => AuthorityType::System,
        ]);

        echo "\n" . 'SquidAPIToken: ' . $squidUser->createToken('squid')->plainTextToken . "\n\n";
    }

    /**
     * @return void
     */
    private function createUniquestAdministrator(): void
    {
        User::factory()->create([
            'name' => 'UQテストユーザー',
            'email' => 'uq_employee@example.com',
            'authority_type' => AuthorityType::UniquestAdministrator,
        ]);
    }

    /**
     * @return void
     */
    private function createTestUser(): void
    {
        $funeralCompany = FuneralCompany::where(
            'squid_id',
            config('squid.test_user_funeral_company_squid_id')
        )->first();

        User::factory()->for($funeralCompany)->create([
            'name' => 'テストユーザー',
            'email' => 'assets-log@example.com',
            'authority_type' => AuthorityType::Administrator,
        ]);

        $this->createDummyUsers($funeralCompany);
    }

    /**
     * @return void
     */
    private function createDummyCompanyUsers(): void
    {
        $funeralCompany = FuneralCompany::where(
            'squid_id',
            config('squid.other_test_user_funeral_company_squid_id')
        )->first();

        $this->createDummyUsers($funeralCompany);
    }

    /**
     * @param FuneralCompany $funeralCompany
     *
     * @return void
     */
    private function createDummyUsers(FuneralCompany $funeralCompany): void
    {
        User::factory()->count(5)->for($funeralCompany)->create();
    }
}
