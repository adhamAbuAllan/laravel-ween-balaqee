<?php

namespace App\Http\Controllers\old_controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $citys = City::all();
        return $citys;
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
        //
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
