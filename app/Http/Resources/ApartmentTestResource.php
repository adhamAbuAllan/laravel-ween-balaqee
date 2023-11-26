<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApartmentTestResource extends JsonResource
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
//            "owner_id" => new UserResource($user),

            "id" =>$this->id,
            "city" => $this->city,
            "updated_at" => $this->updated_at ?? "",
//            "is_booking"=>$this->is_booking ?? "",
//            "token"=>$this->token ?? "",
        ];

    }
}
