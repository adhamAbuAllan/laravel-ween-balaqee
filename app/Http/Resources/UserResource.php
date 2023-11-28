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
            "subscribtion_id"=>$this->subscribtion??-1,
            /*
       * be careful !!!
       * don't delete those two lines those tables of database
       * -------------------------------------------------
         "university"=> new UniversityResource($this->university),
          'type' =>new TypeOfUserResource($this->type),
       * -------------------------------------------------
      */
          "university"=>$this->university??"",
            'type'=>$this->type??"",

//    ($this->type),
            //   TypeOfUser::find($this->type_id),// ?? "" ,
            'gender'=>$this->gender??"",
            'created_at'=>$this->create_at??date("Y-m-d"),
            "token" => $this->token,
//            'updated_at'=>$this->updated_at??"",
            'email'=>$this->email ?? "",
//            'random_password'=>$this->random_password,

//        'gender' => $this->gender,

        ];
//        return parent::toArray($request);
    }
}
