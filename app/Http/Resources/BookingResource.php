<?php

namespace App\Http\Resources;

use App\Models\Apartment;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'apartment'=>new ApartmentResource($this->apartment),
            'user_id'=>$this->user_id,
            'price'=> new  ApartmentResource($this->apartment->price),
            'from_date'=>$this->from_date,
            'to_date'=>$this->to_date,
            'total_price'=>$this->total_price,
            'month_count'=>$this->month_count,
            'current_date'=>$this->current_date,
            '$is_booking'=>$this->is_booking
        ];

    }
}
