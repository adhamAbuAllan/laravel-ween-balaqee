<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryPhoneNummberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            "country_name" =>$this->country_name??"",
            "country_phone_number" =>$this->country_phone_number??"",
            "created_at" =>$this->created_at ?? "",
            "updated_at"=>$this->updated_at??""
        ];    }
}
