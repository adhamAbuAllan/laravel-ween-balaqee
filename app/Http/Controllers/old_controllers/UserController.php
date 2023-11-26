<?php

namespace App\Http\Controllers\old_controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    //registration
    public function register(Request $request)
    {
        $fields = [
            "name" => "required",
            "phone" => "required|unique:users",
            "password" => "required",
            "type"=>"required",
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
//        $token = $request->token;
        $user = User::create([
            'name' => $name,
            'phone' => $phone,
            'password' => $password,
//            'token' =>$token
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


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return $users;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::where('id',$id)->with(['university','city'])->first();
       return $user;

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
