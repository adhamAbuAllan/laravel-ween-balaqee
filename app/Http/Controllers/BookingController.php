<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApartmentResource;
use App\Http\Resources\BookingResource;
use App\Models\Apartment;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
//    public function booking_info($id)
//    {
////        return Booking::where(['id' => $id, 'is_booking' => 'not booking'])->get()->first();
//    }
    public function get_apartment_info($id)
    {
        return Apartment::where(['id' => $id, 'active' => 1])->with('price')->get()->first();
    }

    public function add(Request $request){
//        return $request->all();


        $fields = [

            "apartment_id"=>"required|exists:apartments,id",
            "user_id"=>"required|exists:users,id",
            "price"=>"exists:apartments,price",
            "from_date",
            "to_date",
            "total_price",
            "is_booking",
            "month_count"=>"required",
            "current_date"
        ];

        $valid = Validator::make($request->all(),$fields);
        if($valid->fails()){
            $msg = $valid->messages()->first();
            return $this->fail($msg);
        }
//        $apartmentTable = Apartment::find($this->apartment_id);


        $apartment = $request->apartment_id;
//        $apartment = Apartment::findOrFail($request->apartment_id); // Assuming you have an 'apartment_id' in the request
//        $booking = new Booking();
//        $booking->apartment_id =
//            $apartment->id;
//        $booking->price = $apartment->price;
//        $user = User::findOrFail($request->user_id); // Assuming you have a 'user_id' in the request

        // Create the booking
//        $booking->user_id = $user->id;
        // Set other booking fields
        // ...
//        $booking->from_date;


//        $user= $user->id;
        $monthCount = $request->month_count;
        $from_date  = date("Y-m-d");
        $to_date = date("Y-m-d", strtotime("+$monthCount months"));
//        $price = $request->price;
//        $booking->save();
        $total_price = $apartment->price*$monthCount;
        $current_date = date("Y-m-d");
        $is_booking = "not booking";
        if ( "current_date"<=$to_date ){
            $is_booking = "booking";
            $msg = "the apartment is booking";
            return $msg;

        }



//        $title  = $request->title;
//        $price = $request->price;
        $data = Booking::create([
            'price'=>$apartment->price,
            "apartment_id"=>$apartment,
            "user_id"=>$request->user_id,
            "from_date"=>$from_date,
            "total_price"=>$total_price,
            "is_booking"=>$is_booking,
            "to_date"=>$to_date,
            "month_count"=>$monthCount,
            "current_date"=>$current_date,



        ]);
        return $this->success(new BookingResource($data));
    }
    public function all(){
        $apartments = Booking::all();
        $apartmentResource  = BookingResource::collection($apartments);
        return $this->success($apartmentResource);
    }

}
