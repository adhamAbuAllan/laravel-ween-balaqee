<?php

namespace App\Http\Controllers\old_controllers;


use App\Http\Controllers\Apartment;
use App\Models\TypeOfApartment;
use Illuminate\Http\Request;
use TypeOfApartment;

class TypeOfApartmentController extends Controller
{
    public  function all(){
//        $type = TypeOfApartment::all();
//        return $this->success($type);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TypeOfApartment::with('city')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $a = new TypeOfApartment();

        $a->id = 0;
        $a->product_name = $request->product_name;

        $a->save();

        return $a;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return  TypeOfApartment::where('id',$id)->first();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $a =  TypeOfApartment::where('id',$id)->first();
        $a->id = 0;
        $a->product_name = $request->product_name;

        $a->save();
        return $a;
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
