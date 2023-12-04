<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApartmentResource;
use App\Models\Apartment;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApartmentController extends Controller
{
    public function get_apartment_info($id)
    {
        return  Apartment::where(['id' => $id, 'active' => 1])->
        with('advantages')->
        get()->first();

    }

    public function add(Request $request)
    {
//        return $request->all();

        $fields = [

            "rooms" => "required",
//            ""=>"",
            "bathrooms" => "required",
            "square_meters" => "required",
            "title" => "required",
            "description" => "required",
            "location" => "required",
            "price" => "required",
            "type_id" => "required|exists:type_of_apartments,id",
            "city_id" => "required|exists:cities,id",
            "count_of_student" => "required",
//            "phone" => "required",
//            "photo"=>"required",


            /*
             * under two lines is will delete after fix
             * dropdown button save data
             */
//            "first_image",
//            if is_booking have value '1' that is not booking yet.
            //and  is booking if that have value '2'
//            "is_booking" => "required|",
            /*
             *Be careful !!
             * don't delete those lines is important in future
            --
                "type_id" => "required|exists:type_of_apartments,id",
                "city_id" => "required|exists:cities,id",
            --
            */
        ];

        $validator = Validator::make($request->all(), $fields);
        $valid = $validator;
        if ($valid->fails()) {
            $msg = $valid->messages()->first();
            $res = [
                'status' => false,
                'msg' => $msg,
                'data' => null
            ];

            return response()->json($res, 404);
        }


        $owner = $request->user();
        $apatment = $request->apartment;
        $owner_id = $owner->id;
        $title = $request->title;
        $price = $request->price;
        $rooms = $request->rooms;
        $bathrooms = $request->bathrooms;
        $square_meters = $request->square_meters;
        $description = $request->description;
        $location = $request->location;
        $type_id = $request->type_id;
        $city_id = $request->city_id;
        $countOfStudent = $request->count_of_student;
        //$phone = $request->phone;


        //        $user =  $request->user();
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
//        $type = $request->type;
        /*
*Be careful !!
* don't delete those lines is important in future
--
$city  = $request->city_id;
$type = $request->type_id;
--
*/
        /*
    * under two lines is will delete after fix
    * dropdown button save data
    */
//        $post    = $request->post; //post
//        $image = $request->file('image');
//        $name = 'img_'.date('Ymdhis').'.'.$image->extension();
//        $dir = "images/posts";
//        $image->move(public_path($dir),$name);
//        $path = $dir.'/'.$name;
//        $files = [];
//        if($request->hasfile('image'))
//        {
//            foreach($request->file('image') as $file)
//            {
//                $name = time().random_int(1,50).'.'.$file->extension();
//                $file->move(public_path('images/posts'), $name);
//                $files[] = $name;
//            }
//        }
//
//        $file= new Apartment();
//        $request->image = $files;
//        $file->save();
        $data = Apartment::create([

            'title' => $title,
            'price' => $price,
            'rooms' => $rooms,
            'location' => $location,
            'bathrooms' => $bathrooms,
            'square_meters' => $square_meters,
            'description' => $description,
            'owner_id' => $owner_id,
//            'first_image'=>$firstImage,

            /*
            * under two lines is will delete after fix
            * dropdown button save data
            */
            'type_id' => $type_id,
            'city_id' => $city_id,
            'count_of_student' => $countOfStudent,
//"token"=>$owner->token,


//            'image'=>$path,
//            'owner_id'=>User::where('id', $request->id),


//            'images'=>$file,

            /*
       *Be careful !!
       * don't delete those lines is important in future
      --------
            'type_id'=>$type,
            'city_id'=>$city,
      --------
      */


        ]);
//        $data['image'] = url($data['image']); // to add full url to the image
//        $data = ApartmentResource::collection($data);
        return $this->success(new ApartmentResource($data));
    }

    public function show($apartmentId)
    {
        $apartment = Apartment::find($apartmentId);

        if ($apartment) {
            $advantages = $apartment->advantages;
            return view('apartment.show', ['apartment' => $apartment, 'advantages' => $advantages]);
        } else {
            return "not found";
        }
    }

//    public function all(Request $request)
//    {
//
//        $apartments = Apartment::all();
//
//        $apartmentResource = ApartmentResource::collection($apartments);
//        return $this->success($apartmentResource);
//    }
    public function all(Request $request)
    {
        // Get the 'type' parameter from the request
        $type = $request->input('type');

        // Query apartments based on the type if provided
        $apartments = $type
            ? Apartment::where('type', $type)->get()
            : Apartment::all();

        $apartmentResource = ApartmentResource::collection($apartments);

        return $this->success($apartmentResource);
    }

    public function one(Request $request)
    {
        $fields = ["id" => "required|exists:apartments,id"];
        $valid = Validator::make($request->all(), $fields);
        if ($valid->fails()) {
            return $this->fail($valid->messages()->first());
        }
        $id = $request->id;
        $apartment = $this->get_apartment_info($id);
        $apartmentResource = new ApartmentResource($apartment);
        return $this->success($apartmentResource);
    }

    public function delete(Request $request)
    {
        $fields = ["id" => "required|exists:apartments,id"];

        $valid = Validator::make($request->all(), $fields);
        if ($valid->fails()) {
            $msg = $valid->messages()->first();
            return $this->fail($msg);
        }
        $id = $request->id;
        $apartment = $this->get_apartment_info($id);
        $del = $apartment->delete();
        return $this->success($del);

    }

    public function update(Request $request)
    {
        $fields = ["id" => "required|exists:apartments,id"];
        $valid = Validator::make($request->all(), $fields);
        if ($valid->fails()) {
            $msg = $valid->messages()->first();
            return $this->fail($msg);
        }
        $id = $request->id;
        $apartment = Apartment::find($id);
        $newdata = [];
        if ($request->rooms) {
            $newdata['rooms'] = $request->rooms;
        }
        if ($request->bathrooms) {
            $newdata['bathrooms'] = $request->bathrooms;
        }
        if ($request->square_meters) {
            $newdata['square_meters'] = $request->square_meters;
        }
        if ($request->title) {
            $newdata['title'] = $request->title;
        }
        if ($request->description) {
            $newdata['description'] = $request->description;
        }
        if ($request->location) {
            $newdata['location'] = $request->location;
        }
        if ($request->price) {
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
        $apartment = $this->get_apartment_info($id);
        $apartmentResource = new ApartmentResource($apartment);
        unset($apartmentResource['city_id'], $apartmentResource['type_id']);
        return $this->success($apartmentResource);


    }
}
