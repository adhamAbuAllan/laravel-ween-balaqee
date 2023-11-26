<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApartmentAdvantageResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            "apartment_id"=>$this->apartment_id??0,
            "advantage_id"=>$this->advantge_id??0,
//            "advantages" =>$this->advantages,

        ];
    }
}
