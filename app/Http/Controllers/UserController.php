<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
//    protected $hidden =  ['updated_at'];

    //registration
    public function register(Request $request)
    {
        $fields = [
            "name" => "required",
            "phone" => "required|unique:users",
            "password" => "required",
            /*
* be careful !!!
* don't delete those two lines those tables of database
* ------------------------------------------------
             * 'type_id'=>"exists:type_of_users,id",
            'university_id'=>"exists:universities,id",
* -------------------------------------------------
*/
            'gender',
            'type',
            'university',
            'email'

//            "type"=>"required|exists:type_of_user,id",

//            "token" =>"required"
        ];
        $valid = Validator::make($request->all(), $fields);
        if ($valid->fails()) {
            $msg = $valid->messages()->first();
            return $this->fail($msg);
        }

        $password = app('hash')->make($request->password);
        $phone = $request->phone;
        $name = $request->name;
        $gender = $request->gender;
        /*
     * be careful !!!
     * don't delete those two lines those tables of database
     * ------------------------------------------------
        $type = $request->type_id;
        $university = $request->university_id;
     * -------------------------------------------------
     */

        $type = $request->type;
        $university = $request->university;
        $email = $request->email;
//        $token = $request->token;


//        $numbers = mt_rand(1000, 9999);
//        // Generate 4 random alphabetical characters
//        $characters = str_shuffle('abcdefghijklmnopqrstuvwxyz');
//        $alphabets = substr($characters, 0, 4);
//        // Combine numbers and alphabets
//        $random_password = $numbers . $alphabets;

        $user = User::create([
            'name' => $name,
            'phone' => $phone,
            'password' => $password,
            'gender' => $gender,
            'email' => $email,
//            'random_password' => $random_password
            /*
* be careful !!!
* don't delete those two lines those tables of database
* ------------------------------------------------
          'university_id'=>$university,
            'type_id' => $type,
* -------------------------------------------------
*/
//            'token' =>$token
        'type'=>$type,
            'university'=>$university
        ]);
        $user = User::find($user->id);
        $user['token'] = $user->createToken("UserToken")->plainTextToken;
        return $this->success(new UserResource($user));
    }
    //login
    public function login(Request $request)
    {
        $fields = [
            "phone" => "required",
            "password" => "required",

        ];
        $valid = Validator::make($request->all(), $fields);
        if ($valid->fails()) {
            $msg = $valid->messages()->first();
            return $this->fail($msg);
        }
        $done = auth()->attempt([
            'phone' => $request->phone,
            'password' => $request->password
        ]);
        if ($done) {
            $user = auth()->user();
//            $user['profile'] = url($user->profile);
                $user['token'] = $user->createToken("UserToken")->plainTextToken;

            return $this->success(new UserResource($user));
        }

//

        return $this->fail("user not found");
//            response()->json($res, 404);

    }

    public function profile(Request $request)
    {
        $fields = ["profile" => "required"];
        $valid = Validator::make($request->all(), $fields);

        if ($valid->fails()) {
            $msg = $valid->messages()->first();
            return $this->fail($msg);
        }
        $profile = $request->file('profile');
        $name = 'img_' . date('Ymdhis') . '.' . $profile->extension();
        $dir = "images/profiles";
        //$fulldir = "/home/akram/public_html/".$dir;
        //for Cpanel
        //$profile->move($fulldir,$name);
        //for Localhost
        $profile->move(public_path($dir), $name);
        $path = $dir . '/' . $name;
        $data = url($path);
        $user = $request->user();
        $user->update(['profile' => $path]);
        $user = User::find($user->id);
        $user['profile'] = url($user->profile);

        return $this->success(new UserResource($user));

    }
    public function index()
    {
        $users = User::all();
        return $users;

    }

    public function all(Request $request)
    {
        $d = User::select('users.*')
            ->addSelect(DB::raw('COUNT(apartments.id) as apartment_count'))
            ->leftJoin('apartments', 'users.id', '=', 'apartments.owner_id')
            // ->leftJoin('likes', 'posts.id', '=', 'likes.post_id')
            // ->where('likes.user_id', '=',1) // additional condition on likes table
            ->where('users.active', '=', '1') // additional condition on users table
            ->groupBy('users.id')
            ->orderBy('users.created_at', 'desc')
            ->get();

        return $d;

    }
    public function createRandomPasswordToUser()
    {

        // Generate 4 random numbers
        $numbers = mt_rand(1000, 9999);
        // Generate 4 random alphabetical characters
        $characters = str_shuffle('abcdefghijklmnopqrstuvwxyz');
        $alphabets = substr($characters, 0, 4);
        // Combine numbers and alphabets
        $random_password = $numbers . $alphabets;

        // Return the generated fun code
        return response()->json(['password' => $random_password]);
    }


}
