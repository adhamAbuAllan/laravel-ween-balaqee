<?php

namespace App\Http\Controllers;

use App\Models\SubsecrpionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubsecrpionPlanController extends Controller
{
    public function addSubsecrpionPlan(Request $request)
    {
        $fields = [
            'type' => 'required',
            'description' => 'required',
            'price' => 'required',
        ];

        $validator = Validator::make($request->all(), $fields);

        if ($validator->fails()) {
            $msg = $validator->messages()->first();
            return $this->fail($msg);
        }

        $type = $request->input('type');
        $description = $request->input('description');

        $price = $request->input('price');
        $data = SubsecrpionPlan::create([
            'documentary_photo' => $type,
            'payment_status' => $description,
            'start_date' => $price,

        ]);

        return $this->success($data);
    }

}
