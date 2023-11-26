<?php

namespace App\Http\Controllers\old_controllers;

use App\Http\Controllers\Apartment;
use App\Models\Apartment_Advantage;
use Illuminate\Http\Request;

class Apartment_AdvantageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Apartment_Advantage::with('city')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $apartment_Advantage = new Apartment_Advantage();

        $apartment_Advantage->apartment_id = $request->apartment_id;
        $apartment_Advantage->advantage_id = $request->advantage_id;

        $apartment_Advantage->save();

        return $apartment_Advantage;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return  Apartment_Advantage::where('id',$id)->first();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $apartment_advantage =  Apartment_Advantage::where('id',$id)->first();

        $apartment_advantage->apartment_id = $request->apartment_id;
        $apartment_advantage->advantage_id = $request->advantage_id;

        $apartment_advantage->save();
        return $apartment_advantage;

    }

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
