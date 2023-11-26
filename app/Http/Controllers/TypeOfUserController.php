<?php

namespace App\Http\Controllers;

use App\Http\Resources\TypeOfUserResource;
use App\Models\TypeOfUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeOfUserController extends Controller
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
        $name =  $request->name;
        $data = TypeOfUser::create([
            'name'=>$name,
        ]);

        return $this->success($data);
    }

    public function all(){
        $type = TypeOfUser::all();
        $typeOfUserResource  = TypeOfUserResource::collection($type);

        return $this->success($typeOfUserResource);

    }

}

