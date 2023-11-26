<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Apartment;

class PhotoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $apartment = Apartment::find($this->id);
        $allApartment = Apartment::all();
        return  [
            'url'=>$this->url??"",
            'apartment_id'=>$this->$apartment,

        ];
    }
}
