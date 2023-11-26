<?php

namespace App\Http\Controllers\old_controllers;


use App\Models\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function all(){
        $universities = University::all();
        return $this->success($universities);


    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return University::with('city')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $a = new University();

        $a->id = 0;
        $a->university_name = $request->university_name;

        $a->save();

        return $a;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return  University::where('id',$id)->first();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $a =  University::where('id',$id)->first();
        $a->id = 0;
        $a->university_name = $request->university_name;

        $a->save();
        return $a;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $a = University::where('id',$id)->first();
        $a->delete();

        return true;
    }
}
