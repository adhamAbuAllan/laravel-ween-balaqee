<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'name' => $this->name ?? "",
            'phone' => $this->phone ?? "" ,
            'type_id' => $this->type_id ??6,
           'country_phone_number_id'=>$this->country_phone_number??2,
            /*
       * be careful !!!
       * don't delete those two lines those tables of database
       * -------------------------------------------------
         "university"=> new UniversityResource($this->university),
          'type' =>new TypeOfUserResource($this->type),
       * -------------------------------------------------
      */

//    ($this->type),
            //   TypeOfUser::find($this->type_id),// ?? "" ,
            'created_at'=>$this->create_at??date("Y-m-d"),
            "token" => $this->token,
//            'updated_at'=>$this->updated_at??"",

//            'random_password'=>$this->random_password,

//        'gender' => $this->gender,

        ];
//        return parent::toArray($request);
    }
}
