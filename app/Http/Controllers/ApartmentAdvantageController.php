<?php

namespace App\Http\Controllers;

use App\Models\Advantage;
use App\Models\Apartment;
use App\Models\Apartment_Advantage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApartmentAdvantageController extends Controller
{



    public function getAdvantagesForApartment(Request $request)
    {
        $apartmentId = $request->input('apartmentId');

        // Get the apartment with its associated advantages based on apartment_id
        $apartment = Apartment::with('advantages')->find($apartmentId);

        if (!$apartment) {
            return response()->json(['status' => false, 'msg' => 'Apartment not found'], 404);
        }

        // Get the unique advantage_ids associated with the apartment
        $advantageIds = $apartment->advantages->pluck('id')->unique();

        // Get the data from the Advantage table for each unique advantage_id
        $advantageData = Advantage::whereIn('id', $advantageIds)->get();

        return response()->json(['status' => true, 'data' => $advantageData]);
    }

//    public function getAdvantagesForApartment($apartmentId)
//    {
//        // Get the apartment with its associated advantages based on apartment_id
//        $apartment = Apartment::with('advantage')->find($apartmentId);
//
//        if (!$apartment) {
//            return response()->json(['status' => false, 'msg' => 'Apartment not found'], 404);
//        }
//
//        // Get the unique advantage_ids associated with the apartment
//        $advantageIds = $apartment->advantage->pluck('id')->unique();
//
//        // Get the data from the Advantage table for each unique advantage_id
//        $advantageData = Advantage::whereIn('id', $advantageIds)->get();
//
//        return response()->json(['status' => true, 'data' => $advantageData]);
//    }


//    public function getAdvantagesForApartment($apartmentId, $advantageId)
//    {
//        $advantages = Advantage::where('id', $advantageId)->get();
//
//        if ($advantages->isEmpty()) {
//            return response()->json(['status' => false, 'msg' => 'No data found'], 404);
//        }
//
//        return response()->json(['status' => true, 'data' => $advantages]);
//    }

    public function showAdvantage($advantageId)
    {
        $advantages = Advantage::where('id', $advantageId)->get();

        if ($advantages->isEmpty()) {
            return response()->json(['status' => false, 'msg' => 'No data found'], 404);
        }

        return response()->json(['status' => true, 'data' => $advantages]);
    }

    public function insertAdvInApartment(Request $request)
    {
        $fields = [
            'apartment_id' => 'required|exists:apartments,id',
            'advantage_id' => 'required|exists:advantages,id',
        ];
        $validator = Validator::make($request->all(), $fields);
        if ($validator->fails()) {
            $msg = $validator->messages()->first();
            return $this->fail($msg);
        }

        $apartment_id = $request->apartment_id;
        $advantage_id = $request->advantage_id;
        $data = Apartment_Advantage::create([
                'apartment_id' => $apartment_id,
                'advantage_id' => $advantage_id,

            ]

        );



        return $this->success($data) ;
    }

//    public function show(string $id)
//    {
//        return Apartment_Advantage::where('id',$id)->first();
//    }

    public function insertAdvInApartment2(Request $request): \Illuminate\Http\JsonResponse
    {
        $fields = [
            'data.*.apartment_id' => 'required|exists:apartments,id',
            'data.*.advantage_id' => 'required|exists:advantages,id',
        ];

        $validator = Validator::make($request->all(), $fields);

        if ($validator->fails()) {
            $msg = $validator->messages()->first();
            return $this->fail($msg);
        }

        $data = $request->input('data');

        foreach ($data as $item) {
            Apartment_Advantage::create([
                'apartment_id' => $item['apartment_id'],
                'advantage_id' => $item['advantage_id'],
            ]);
        }

        return $this->success("Data inserted successfully");
    }

    public function insertAdvInApartment3(Request $request): \Illuminate\Http\JsonResponse
    {
        $fields = [
            'apartment_id' => 'required|exists:apartments,id',
            'advantages' => 'required|array',
            'advantages.*' => 'exists:advantages,id',
        ];

        $validator = Validator::make($request->all(), $fields);

        if ($validator->fails()) {
            $msg = $validator->messages()->first();
            return $this->fail($msg);
        }

        $apartment_id = $request->input('apartment_id');
        $advantage_ids = $request->input('advantages');

        $data = [];

        foreach ($advantage_ids as $advantage_id) {
            $apartmentAdvantage = Apartment_Advantage::create([
                'apartment_id' => $apartment_id,
                'advantage_id' => $advantage_id,
            ]);

            $data[] = $apartmentAdvantage;
        }

        return $this->success($data);
    }





}
