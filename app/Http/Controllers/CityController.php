<?php

namespace App\Http\Controllers;

use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    public function add(Request $request){
        $fields = [
            'name'=>"required",
        ];
        $valid = Validator::make($request->all(),$fields);
        if($valid->fails()){
            $msg = $valid->messages()->first();
            $res = [
                'status'=>false,
                'msg'=>$msg,
                'data'=>null
            ];
            return response()->json($res,404);
        }
        $city_name =  $request->name;
        $data = City::create([
            'name'=>$city_name,
        ]);
        $res = [
            'status'=>true,
            'msg'=>"success",
            'data'=>$data
        ];
        return response()->json($res,200);
    }

    public function all(){
        $type = City::all();
        $typeOfUserResource  = CityResource::collection($type);

        return $this->success($typeOfUserResource);

    }
}
