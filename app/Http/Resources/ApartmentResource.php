<?php

namespace App\Http\Resources;

use App\Models\Advantage;
use App\Models\Apartment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $user = User::find($this->owner_id);
        $advantages = Advantage::find($this->advantage_id);

//        return $this->name;
        return [
            "id" =>$this->id,

//            "owner_id" => new UserResource($user),
            "owner" => $user,

//

//        owner,
//            "is_booking"=>$this->is_booking,

                "photos"=>$this->photo,
//            "phone"=>User::find($this->owner_id)->phone,
            "rooms" => $this->rooms ?? "",
            "bathrooms" => $this->bathrooms ?? "",
            "square_meters" => $this->square_meters ?? "",
            "title" => $this->title ?? "",
            "description" => $this->description ?? "",
            "location" => $this->location ?? "",
            "price" => $this->price ?? 0.0,
            "city" => $this->city??"",

            "type" => $this->type??"",
            "advantage" =>  $this->advantages,
//            "advantages" =>  $this->advantages,
            "count_of_student"=>$this->count_of_student??0,
            "active"=>$this->active??1,
//            'phone'=>$this->phone??0,
//            'first_image'=>$this->first_image??"",
//            "booking-id"=>$this
            /*
        *Be careful !!
        * don't delete those lines is important in future
          you should know in those lines is not like up two lines
            those lines is object but up lines is string type data
        -----------------
           "city" => $this->city,
            "type" => $this->type,
        --------------------
*/





            "updated_at" => $this->updated_at ?? "",
//            "is_booking"=>$this->is_booking ?? "",
//            "token"=>$this->token ?? "",
        ];

    }
}
