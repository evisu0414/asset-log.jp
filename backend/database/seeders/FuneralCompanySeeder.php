<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\FuneralCompany;
use Illuminate\Database\Seeder;

class FuneralCompanySeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        $this->createFuneralCompany();
        $this->createOtherFuneralCompany();
    }

    /**
     * @return void
     */
    private function createFuneralCompany(): void
    {
        FuneralCompany::factory()->create([
            'squid_id' => config('squid.test_user_funeral_company_squid_id'),
        ]);
    }

    /**
     * @return void
     */
    private function createOtherFuneralCompany(): void
    {
        FuneralCompany::factory()->create([
            'squid_id' => config('squid.other_test_user_funeral_company_squid_id'),
        ]);
    }
}
