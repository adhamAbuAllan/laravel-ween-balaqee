<?php

namespace App\Http\Controllers;

use App\Models\CityTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityTestController extends Controller
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
        $city_name =  $request->name;
        $data = CityTest::create([
            'name'=>$city_name,
        ]);

        return $this->success($data);
    }

    public function all(){
        $cities = CityTest::all();

        return $this->success($cities);

    }
}
