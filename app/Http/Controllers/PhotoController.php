<?php

namespace App\Http\Controllers;

use App\Http\Resources\PhotoResource;
use App\Models\Apartment;
use App\Models\Photo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PhotoController extends Controller
{


//    public function showImages($apartment_id)
//    {
//        $photos = Photo::where('apartment_id', $apartment_id)->get();
//        return view('show_images', ['photos' => $photos]);
//    }
//    public function showImages($ap 1artment_id)
//    {
//        $photos = Photo::where('apartment_id', $apartment_id)->get();
//        return response()->json($photos);
//    }

    public function showImages($apartment_id)
    {
        $photos = Photo::where('apartment_id', $apartment_id)->get();
        $imageUrls = $photos->pluck('url')->toArray();
        return response()->json(['image_urls' => $imageUrls]);
    }

    public function addImages(Request $request)
    {
        $fields = [
            'apartment_id' => 'required|exists:apartments,id',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $validator = Validator::make($request->all(), $fields);

        if ($validator->fails()) {
            $msg = $validator->messages()->first();
            return $this->fail($msg);
        }


        $uploadedImages = [];

        $images = $request->file('images');

        if (!is_array($images)) {
            return $this->fail('Images must be an array.');
        }
        $apartmentId = $request->input('apartment_id');

        foreach ($images as $image) {
            $imageName = 'img_' . rand(1, 150000) . '.png';
//            'img_'.date('Ymdhis').'.'.$image->extension();
            $dir = "images/apartments_images";
            $image->move($dir, $imageName);
            $path = $dir . '/'
                .
                $imageName;
            $quitUrl = 'https://weenbalaqee.com/' . $path;

            $data = Photo::create([
                'url' => $quitUrl,
                'apartment_id' => $apartmentId,
            ]);

            $uploadedImages[] = new PhotoResource($data);
        }

        return $this->success($uploadedImages);
    }




//public function add(Request $request){
//    $image = $request->file('image');
//    $name = 'img_'.date('Ymdhis').'.'.$image->extension();
//    $dir = "images/apartment";
//    $image->move(public_path($dir),$name);
//    $path = $dir.'/'.$name;
//
//    $res = [
//        'status'=>true,
//        'msg'=>"success",
//        'data'=>$path
//    ];
//    return response()->json($res,200);
//}


//public function uploadImages(Request $request)
//{
//    $request->validate([
//        'apartment_id' => 'required|exists:apartments,id',
//        'url' => 'required|array',
//        'url.*' => 'image|mimes:jpeg,png,jpg|max:2048',
//    ]);
//
//    $apartmentId = $request->input('apartment_id');
//    $images = $request->file('images');
//    $files = [];
//
//
//
//    foreach ($images as $image)         foreach($request->file('image_name') as $file)
//    {
//        $name = time().rand(1,50).'.'.$file->extension();
//        $file->move(public_path('images/apartments_images'), $name);
//        $files[] = $name;
//    }
//
//    $apartment = $request->apartment;
////            $file_upload = $request->upload;
////            $image_id = $file_upload->id;
////            $apartment_id = $apartment->id;
//    $file->filenames = $files;
////        $file->apartment_id = $apartmentId;
//    $file->apartment_id = $apartmentId->id;
////        $files[] = $file->id;
//
//
//    $file->save();
//    return back()->with('success', 'Images are successfully uploaded');
////        return response()->json(['message' => 'Images uploaded successfully', 'image_ids' => $uploadedImageIds]);
//}

}
//            'image'=>$path,
//            'photo_id'=>'exists:uploads,id',
//        $post_data['image'] = url($post_data['image']);
//        $apartment = Apartment::find($this->apartment_id);
//        $apartment = Apartment::find($request->id);
//        $file->apartment_id = $request->apartment_id;
//        $apartment_id = $apartment->id;
//        if ($request->hasFile('images')) {
//
//            $path = $request->file('images')->store('images');
//            $file->url = $path;
//        }
//        $file->save();
//        $file = Photo::create([
//            'url'=>$file->url,
//            'apartment_id'=>$file->apartment_id,
//        ]);
//        return new PhotoResource($file);
//        return back()->with('success', 'Images are successfully uploaded');
//        $post_data = Photo::create([
//            'url'=>$files,
//            'image'=>$path,
//            'apartment_id'=>$file
//        ]);
