<?php

namespace App\Http\Controllers;

use App\Http\Resources\OwnSubscriptionResource;
use App\Models\Subsecrpion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubsecrpionController extends Controller
{

    public function getSubsecrptionOfUser(Request $request)
    {
        $userId = $request->input('userId');

        // Get the apartment with its associated advantages based on apartment_id
        $user = User::with('subscribtions')->find($userId);

        if (!$user) {
            return response()->json(['status' => false, 'msg' => 'user not found'], 404);
        }

        // Get the unique advantage_ids associated with the apartment
        $subscribtionsIds = $user->subscribtions->pluck('id')->unique();

        // Get the data from the Advantage table for each unique advantage_id
        $subscribtionsData = Subsecrpion::whereIn('id', $subscribtionsIds)->get();

        return response()->json(['status' => true, 'data' =>new OwnSubscriptionResource($$subscribtionsData)]);
    }





    public function createSubsecrpion(Request $request)
    {
        $fields = [
            'payment_status' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'plan_id' => 'required|exists:subsecrpion_plans,id',
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

        $payment_status = $request->input('payment_status');;
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $plan_id = $request->input('plan_id');
        $user_id = $request->input('user_id');
        $uploadedImages = [];

        $images = $request->file('images');

        if (!is_array($images)) {
            return $this->fail('Images must be an array.');
        }

        foreach ($images as $image) {
            $imageName = 'img_' . rand(1, 9500) . '.png';
//            'img_'.date('Ymdhis').'.'.$image->extension();
            $dir = "images/subsections_photos";
            $image->move($dir, $imageName);
            $path = $dir . '/'
                .
                $imageName;
            $quitUrl = 'https://weenbalaqee.com/public_html/' . $path;
            $data = Subsecrpion::create([
                'documentary_photo' => $quitUrl,
                'payment_status'=>$payment_status,
                'start_date'=>$start_date,
                'end_date'=>$end_date,
                'plan_id'=>$plan_id,
                'user_id'=>$user_id,
            ]);

            $uploadedImages[] = new  OwnSubscriptionResource($data);
        }
        return $this->success($uploadedImages);
    }

}
