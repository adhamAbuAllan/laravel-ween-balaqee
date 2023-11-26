<?php

namespace App\Http\Controllers;

use App\Http\Resources\CityResource;
use App\Http\Resources\UniversityResource;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UniversityController extends Controller
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
        $unviersity_name =  $request->name;
        $data = University::create([
            'name'=>$unviersity_name,
        ]);

        return $this->success($data);
    }

    public function all(){
        $university = University::all();
        $universityRes = UniversityResource::collection($university);


        return $this->success($universityRes);

    }

}
