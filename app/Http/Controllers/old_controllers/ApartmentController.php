<?php

namespace App\Http\Controllers\old_controllers;

use App\Http\Resources\ApartmentResource;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApartmentController extends Controller
{
    public function get_apartment_info($id)
    {
        return Apartment::where(['id' => $id, 'active' => 1])->get()->first();

    }


    public function add(Request $request){

        $fields = [
            "rooms"=>"required",
            "bathrooms"=>"required",
            "square_meters"=>"required",
            "title"=>"required",
            "description"=>"required",
            "location"=>"required",
            "price"=>"required",
            "owner_id"=>"required|exists:users,id",
            "city_id" => "required|exists:cities,id",
            "type_id" => "required|exists:type_of_apartments,id",
//            if is_booking have value '1' that is not booking yet.
            //and  is booking if that have value '2'
//            "is_booking" => "required|",


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

        $user =  $request->user();
        $user_id = $user->id;
//        $id = $request->input('id'); // assuming you're retrieving the ID from a request parameter
//        $user =
//        $userId = $user->id;

//        if ($user && $user->exists()) {
//            // User exists, so you can access its properties safely
//            // ... continue using $user object
//        } else {
//            // User doesn't exist, handle the error or return a response
//            return response()->json(['error' => 'User not found'], 404);
//        }

//        $user_id = $user->id;
        $city_id  = $request->city_id;
//        $type = $request->type;
        $type_id = $request->type_id;

//        $owner_id = $request->owner;
        $title  = $request->title;
        $price = $request->price;
        $rooms = $request->rooms;
        $bathrooms = $request->bathrooms;
        $square_meters = $request->square_meters;
        $description = $request->description;
        $location = $request->location;

//        $post    = $request->post; //post
//        $image = $request->file('image');
//        $name = 'img_'.date('Ymdhis').'.'.$image->extension();
//        $dir = "images/posts";
//        $image->move(public_path($dir),$name);
//        $path = $dir.'/'.$name;

        $data = Apartment::create([
            'title'=>$title,
//            'image'=>$path,
//            'owner_id'=>User::where('id', $request->id),

            'price'=>$price,
            'rooms'=>$rooms,
            'location'=>$location,
            'bathrooms'=>$bathrooms,
            'square_meters'=>$square_meters,
            'description'=>$description,
            'type_id'=>$type_id,
            'city_id'=>$city_id,
            'owner_id'=>$user_id,


        ]);
//        $data['image'] = url($data['image']); // to add full url to the image
        $res = [
            'status'=>true,
            'msg'=>"success",
            'data'=>$data
        ];
        return response()->json($res,200);
    }

    public function all(Request $request){
        $apartments = Apartment::all();
        $apartmentResource  = ApartmentResource::collection($apartments);
        return $this->success($apartmentResource);
    }

    public function one(Request $request){
        $fields = ["id"=> "required|exists:apartments,id"];
        $valid = Validator::make($request->all(),$fields);
        if($valid->fails()){
            return $this->fail($valid->messages()->first());

        }
        $id = $request->id;
        $apartment = $this->get_apartment_info($id);
        $apartmentResource = new ApartmentResource($apartment);
        return $this->success($apartmentResource);

     }

    public function delete(Request $request){
        $fields = ["id"=>"required|exists:apartments,id"];

        $valid = Validator::make($request->all(),$fields);
        if($valid->fails()){
            $msg  = $valid->messages()->first();
            return $this->fail($msg);
        }
        $id = $request->id;
        $apartment = $this->get_apartment_info($id);
        $del = $apartment->delete();
        return $this->success($del);

    }

    public function update(Request $request){
        $fields = ["id"=>"required|exists:apartments,id"];
        $valid = Validator::make($request->all(),$fields);
        if($valid->fails()){
            $msg = $valid->messages()->first();
            return $this->fail($msg);
        }
        $id = $request->id;
        $apartment = Apartment::find($id);
        $newdata=[];
        if($request->rooms){
            $newdata['rooms'] = $request->rooms;
        }
        if($request->bathrooms){
            $newdata['bathrooms'] = $request->bathrooms;
        }
        if($request->square_meters){
            $newdata['square_meters'] = $request->square_meters;
        }
        if($request->title){
            $newdata['title'] = $request->title;
        }
        if($request->description){
            $newdata['description'] = $request->description;
        }
        if($request->location){
            $newdata['location'] = $request->location;
        }
        if($request->price){
            $newdata['price'] = $request->price;
        }



//        if($request->file('image')){
//            $image = $request->file('image');
//            $name = 'img_'.date('Ymdhis').'.'.$image->extension();
//            $dir= "images/posts";
//            $fulldir =
//                $image->move($dir,$name);
//            $path =$dir.'/'.$name;
//            $newdata['image']=$path;
//        }
//        $data = parent::toArray($request);

        $apartment->update($newdata);
        $id = $request->id;
        $apartment =$this->get_apartment_info($id);
        $apartmentResource = new ApartmentResource($apartment);
        unset($apartmentResource['city_id'],$apartmentResource['type_id']);
        return $this->success($apartmentResource);


    }

////////////////////////////////////////////////////
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return Apartment::with('city')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $a = new Apartment();

        $a->is_booking = 0;
        $a->city_id = $request->city_id;
        $a->rooms = $request->rooms;
        $a->bathrooms = $request->bathrooms;
        $a->type_id = $request->type_id;
        $a->square_meters = $request->square_meters;
        $a->title = $request->title;
        $a->description = $request->description;
//            $a->owner_id = Auth::user()->id;
        $a->location = $request->location;
        $a->price = $request->price;

        $a->save();

        return $a;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      return  Apartment::where('id',$id)->first();
    }

    /**
     * Update the specified resource in storage.
     */
//    public function update(Request $request, string $id)
//    {
//        $a =  Apartment::where('id',$id)->first();
//        $a->is_booking = 0;
//        $a->city_id = $request->city_id;
//        $a->rooms = $request->rooms;
//        $a->bathrooms = $request->bathrooms;
//        $a->type_id = $request->type_id;
//        $a->area = $request->area;
//        $a->title = $request->title;
//        $a->description = $request->description;
//        //    $a->owner_id = Auth::user()->id;
//        $a->location = $request->location;
//        $a->price = $request->price;
//
//        $a->save();
//        return $a;
//    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $a = Apartment::where('id',$id)->first();
        $a->delete();

        return true;

    }
}
