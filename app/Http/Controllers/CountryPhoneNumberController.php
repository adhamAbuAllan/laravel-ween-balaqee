<?php

namespace App\Http\Controllers;

use App\Http\Resources\CountryPhoneNummberResource;
use App\Models\CountryPhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountryPhoneNumberController extends Controller
{
    public function add(Request $request){
        $fields = [
            'country_name'=>"required",
            'country_phone_number'=>"required",


        ];
        $valid = Validator::make($request->all(),$fields);
        if($valid->fails()){
            $msg = $valid->messages()->first();

            return $this->fail($msg);
        }
        $country_name=  $request->country_name;
        $country_phone_number=  $request->country_phone_number;
        $data = CountryPhoneNumber::create([
            'country_name'=>$country_name,
            'country_phone_number'=>$country_phone_number,
        ]);

        return $this->success(new CountryPhoneNummberResource($data));
    }

    public function all(){
        $countryPhoneNumber = CountryPhoneNumber::all();
        $typeOfUserResource  = CountryPhoneNummberResource::collection($countryPhoneNumber);

        return $this->success($typeOfUserResource);

    }
}
