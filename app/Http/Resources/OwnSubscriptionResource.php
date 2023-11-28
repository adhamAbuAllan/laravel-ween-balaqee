<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OwnSubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray(Request $request){
        $user = User::find($this->owner_id);

        return [
            "user_id" => $this->$user,
            "documentary_photo"=>$this->documentary_photo,
            "payment_status"=>$this->payment_status,
            "start_date"=>$this->start_date,
            "end_date"=>$this->end_date,
            "plan_id"=>$this->plan_id,

            ];
    }
}
