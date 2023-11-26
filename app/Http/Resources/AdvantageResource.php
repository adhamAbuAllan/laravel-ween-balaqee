<?php

namespace App\Http\Resources;

//use App\Models\boolean;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BookingResource;
class AdvantageResource extends JsonResource
{
    public function toArray($request)
    {
//        $boolean = boolean::find($this->checked_id);
        return [
            'id' => $this->id,
            'adv_name' => $this->adv_name??"",
            'icon' => $this->icon??"",
//            'checked_id'=>new BooleanResource($boolean)
        ];    }
}
