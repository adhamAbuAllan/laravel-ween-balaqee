<?php

namespace App\Http\Controllers\old_controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function add(Request $request){
    $image = $request->file('image');
    $name = 'img_'.date('Ymdhis').'.'.$image->extension();
    $dir = "images/apartment";
    $image->move(public_path($dir),$name);
    $path = $dir.'/'.$name;

    $res = [
        'status'=>true,
        'msg'=>"success",
        'data'=>$path
    ];
    return response()->json($res,200);
}
    public function index()
    {
        return Photo::with('city')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $a = new Photo();

        $a->id = 0;
        $a->apartment_id = $request->apartment_id;
        $a->url = $request->url;

        $a->save();

        return $a;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return  Photo::where('id',$id)->first();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $a =  Photo::where('id',$id)->first();
        $a->id = 0;
        $a->apartment_id = $request->apartment_id;
        $a->url = $request->url;

        $a->save();
        return $a;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $a = Photo::where('id',$id)->first();
        $a->delete();

        return true;
    }
}
