<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request){
        return [
            'id'=> $this->id,
            'type'=> $this->type,
            'description'=> $this->description,
            'price'=> $this->price,
        ];
    }
}
