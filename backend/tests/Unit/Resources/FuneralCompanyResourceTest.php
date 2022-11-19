<?php

declare(strict_types=1);

namespace Tests\Unit\Resources;

use App\Http\Resources\FuneralCompanyResource;
use App\Models\FuneralCompany;
use Tests\TestCase;

class FuneralCompanyResourceTest extends TestCase
{
    /**
     * @return void
     */
    public function testResource(): void
    {
        $funeralCompany = FuneralCompany::factory()->create([
            'name' => 'テスト葬儀社',
        ]);

        $resource = (new FuneralCompanyResource($funeralCompany))->resolve();

        $this->assertSame(
            [
                'id' => $funeralCompany->id,
                'name' => 'テスト葬儀社',
            ],
            $resource,
        );
    }
}
