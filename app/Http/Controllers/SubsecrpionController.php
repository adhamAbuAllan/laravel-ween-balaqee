<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubscriptionResource;
use App\Models\Subsecrpion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubsecrpionController extends Controller
{


    public function createSubsecrpion(Request $request)
    {
        $fields = [
            'payment_status' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'plan_id' => 'required|exists:subscription_plans,id',
            'user_id' => 'required|exists:users,id',
            'created_at',
            'updated_at',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $validator = Validator::make($request->all(), $fields);

        if ($validator->fails()) {
            $msg = $validator->messages()->first();
            return $this->fail($msg);
        }

        $payment_status = $request->payment_status;
        $start_date = $request->start_date->format('Y-m-d');
        $end_date = $request->end_date->format('Y-m-d');
        $plan_id = $request->plan_id;
        $user_id = $request->user_id;
        $uploadedImages = [];

        $images = $request->file('images');

        if (!is_array($images)) {
            return $this->fail('Images must be an array.');
        }

        foreach ($images as $image) {
            $imageName = 'img_' . rand(1, 150000) . '.png';
//            'img_'.date('Ymdhis').'.'.$image->extension();
            $dir = "images/subsections_photos";
            $image->move(public_path($dir), $imageName);
            $path = $dir . '/'
                .
                $imageName;
            $quitUrl = 'https://weenbalaqee.com/' . $path;

            $data = Subsecrpion::create([
                'documentary_photo' => $quitUrl,
                'payment_status'=>$payment_status,
                'start_date'=>$start_date,
                'end_date'=>$end_date,
                'plan_id'=>$plan_id,
                'user_id'=>$user_id,
            ]);

            $uploadedImages[] = new SubscriptionResource($data);
        }
        return $this->success($uploadedImages);
    }

}
