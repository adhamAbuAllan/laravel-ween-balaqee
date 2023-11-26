<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApartmentTestResource;
use App\Models\ApartmentTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApartmentTestController extends Controller
{
    public function add(Request $request){
//        return $request->all();

        $fields = [
            "city_id" => "required|exists:city_tests,id",
        ];

        $valid = Validator::make($request->all(),$fields);
        if($valid->fails()){
            $msg = $valid->messages()->first();

              $numbers = [1,2,3,4,5,6,7,8,9,10];
            for( $i = 0; $i < $numbers; $i++)
    {
        print($numbers[$i]);
    }

            return $this->fail($msg);
        }

        $city  = $request->city_id
        ;

        $data = ApartmentTest::create([

            'city_id'=>$city,

        ]);
//        $data['image'] = url($data['image']); // to add full url to the image
//        $data = ApartmentResource::collection($data);

        return $this->success(new ApartmentTestResource($data));
    }
    public function all(Request $request){
        $apartments = ApartmentTest::all();
        return $this->success($apartments);
    }}


