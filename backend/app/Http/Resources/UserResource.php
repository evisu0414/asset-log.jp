<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * @param $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'funeralCompany' => $this->funeralCompany
                ? new FuneralCompanyResource($this->funeralCompany)
                : null,
            'authorityType' => [
                'value' => $this->authority_type->value,
                'description' => $this->authority_type->description(),
            ],
        ];
    }
}
