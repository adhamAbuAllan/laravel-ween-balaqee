<?php

namespace App\Http\Controllers;

use App\Http\Resources\CityResource;

use App\Http\Resources\TypeOfApartmentResource;
use App\Models\TypeOfApartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeOfApartmentController extends Controller
{
    public function add(Request $request){
        $fields = [
            'name'=>"required",


        ];
        $valid = Validator::make($request->all(),$fields);
        if($valid->fails()){
            $msg = $valid->messages()->first();

            return $this->fail($msg);
        }
        $name =  $request->name;
        $data = TypeOfApartment::create([
            'name'=>$name,
        ]);

        return $this->success(new TypeOfApartmentResource($data));
    }

    public function all(){
        $type = TypeOfApartment::all();
        $typeOfUserResource  = CityResource::collection($type);

        return $this->success($typeOfUserResource);

    }
//    public  function all(){
//        $type = TypeOfApartment::all();
//        return $this->success($type);
//    }

}
