<?php

namespace App\Http\Controllers\old_controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Booking::with('city')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $a = new Booking();

        $a->id = 0;
        $a->user_id = $request->user_id;
        $a->apartment_id = $request->apartment_id;
        $a->price = $request->price;
        $a->months = $request->months;
        $a->from_date = $request->from_date;
        $a->to_date = $request->to_date;
        $a->total_price = $request->total_price;
        $a->statues = $request->statues;

        $a->save();

        return $a;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return  Booking::where('id',$id)->first();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $a =  Booking::where('id',$id)->first();

        $a->id = 0;
        $a->user_id = $request->user_id;
        $a->apartment_id = $request->apartment_id;
        $a->price = $request->price;
        $a->months = $request->months;
        $a->from_date = $request->from_date;
        $a->to_date = $request->to_date;
        $a->total_price = $request->total_price;
        $a->statues = $request->statues;

        $a->save();
        return $a;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $a = Booking::where('id',$id)->first();
        $a->delete();

        return true;
    }
}
