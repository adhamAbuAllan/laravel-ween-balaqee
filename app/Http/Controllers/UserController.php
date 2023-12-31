<?php
//token of project:
//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
//use those commands to make git pull from gitHub to your project in your server
/*

git stash
git pull --rebase
git stash apply

 */
/*
 نبذة عن التطبيق
لا مزيد من إضاعة الوقت في البحث عن شقق للإجار بعد اليوم.

تفاصيل أكثر عن التطبيق
رحلتك في البحث عن شقق سكنية للإجار تبدأ مع تطبيق وين بلاقي. اعثر على الشقق بتصنيفات مختلفة ، و في جميع المدن الفلسطينية ،
إستمتع بواجهة رسومية جذابة ، و بتجربة استخدام مميزة ، واحجز شتقتك المفضلة ، أو أكسب المال و احصل على زبائن بشكل أسرع.

 */
namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\NewAccessToken;


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

            'country_phone_number_id'=>"required|exists:country_phone_numbers,id",
            'type_id'=>"required|exists:type_of_users,id"

            /*
* be careful !!!
* don't delete those two lines those tables of database
* ------------------------------------------------
             * 'type_id'=>"exists:type_of_users,id",
            'university_id'=>"exists:universities,id",
* -------------------------------------------------
*/

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
        $country_phone_number_id = $request->country_phone_number_id;
        /*
     * be careful !!!
     * don't delete those two lines those tables of database
     * ------------------------------------------------
        $type = $request->type_id;
        $university = $request->university_id;
     * -------------------------------------------------
     */

        $type_id = $request->type_id;
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
                'country_phone_number_id'=>$country_phone_number_id,
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
            'type_id' => $type_id,
        ]);
        $user = User::find($user->id);
//        $user['token'] = Str::random(60);

//        $user['token'] = $user->createToken('token')->plainTextToken;
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
            'password' => $request->password,
        ]);
        if ($done) {
            $user = auth()->user();

//            $plainTextToken = sprintf(
//                '%s%s%s',
//                config('sanctum.token_prefix', ''),
//                $tokenEntropy = Str::random(40),
//                hash('crc32b', $tokenEntropy)
//            );

//                $token = hash('sha256', $plainTextToken);



//            $user['profile'] = url($user->profile);
//                $user['token'] = $user->createToken()->plainTextToken;
//            $user['token'] = new NewAccessToken($token, $token->getKey().'|'.$plainTextToken);
            //

            $user['token'] = $user->createToken("UserToken")->plainTextToken;
            $user['subscribtion_id'] = User::with('subscribtions.user_id');

            return $this->success(new UserResource($user)) ;
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
