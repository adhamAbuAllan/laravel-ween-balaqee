<?php

namespace App\Http\Controllers;

use App\Http\Resources\PhotoResource;
use App\Models\Photo;
use App\Models\upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class uploadController extends Controller
{




    public function addImages(Request $request): \Illuminate\Http\JsonResponse
    {
        $fields = [
            'category_of_image' => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $validator = Validator::make($request->all(), $fields);

        if ($validator->fails()) {
            $msg = $validator->messages()->first();
            return $this->fail($msg);
        }


        $uploadedImages = [];

        $images = $request->file('images');
        $categoryOfImage = $request->category_of_image;

        if (!is_array($images)) {
            return $this->fail('Images must be an array.');
        }
//        $apartmentId = $request->input('apartment_id');

        foreach ($images as $image) {
            $imageName = $image->getClientOriginalName() ;
//            'img_'.date('Ymdhis').'.'.$image->extension();
            $dir = "images/$categoryOfImage";
            $image->move(public_path($dir), $imageName);
            $path = $dir . '/'
                .
                $imageName;
            $quitUrl = 'https://weenbalaqee.com/' . $path;

//            $data = Photo::create([
//                'url' => $quitUrl,
//                'apartment_id' => $apartmentId,
//            ]);

            $uploadedImages[] = $quitUrl;
//                new PhotoResource($data);
        }

        return $this->success($uploadedImages);
    }








    public function store(Request $request)
    {
        $this->validate($request, [
            'image_name' => 'required',
            'image_name.*' => 'image',
            'apartment_id'=>'exists:apartments,id',
//            'photo_id'=>'exists:uploads,id',
        ]);

        $files = [];

//        if($request->hasfile('image_name'))
//        {
        foreach ($request->file('image_name') as $file) {
            $name = time() . rand(1, 50 * 50) . '.' . $file->extension();
            $path = $file->move(public_path('images/apartments_images'), $name);
            $files[] = url($path);
        }
//        }


        $file = new upload();
//            $apartment = $request->apartment;
        $file_upload = $request->upload;
//            $image_id = $file_upload->id;
//            $apartment_id = $apartment->id;
        $file->filenames = $files;

        $file->save();
//        $data = upload::create([
//            'apartments_id' =>$apartment_id,
//            'photo_id' =>$image_id,
//            "filenames" =>$file,
//        ]);

//        return response()->json([
//            $data
//        ]);
        return back()->with('success', 'Images are successfully uploaded');
    }

    public function showImage($request)
    {
        $path = storage_path('ages/apartments_images' . $request);

        if (!Storage::disk('public')->exists('images/apartments_images' . $request)) {
            abort(404);
        }

        return response()->file($path);
    }

    public function index()
    {
        $apartment = Upload::all();
//        return view('
//        apartments.php
//        ')->with('apartments', $apartment);
        return $this->success($apartment);

    }

    /*
     * I try multi function to upload images , If you want to delete those functions you can delete them , but I suggest to keep them and try to develop original function.
     */
//    public function index()
//    {
//        return view('welcome');
//    }
//
//    public function store(Request $request)
//    {
//        foreach($request->input('document', []) as $file) {
//            //your file to be uploaded
//            return $file;
//        }
//    }
//
//    public function uploads(Request $request)
//    {
//        $path = storage_path('"images/apartments_images');
//
//        !file_exists($path)&&mkdir($path, 0777, true);
//
//        $file = $request->file('file');
//        $name = uniqid() . '_' . trim($file->getClientOriginalName());
//        $file->move($path, $name);
//
//        return response()->json([
//            'image_name' => $name,
//            'original_name' => $file->getClientOriginalName(),
//        ]);
//    }
//
//    /**
//     * Display a listing of the resource.
//     */
//    public function Index(){
//        $data = DB::table('galleries')->get();
//        return view('gallery1', compact('data'));
//    }
//
////    public function index()
////
////    {
////        $image = upload::get();
////        return view('view_image', compact('image'));
////    }
//
//    /**
//     * Show the form for creating a new resource.
//     */
////    public function create()
////    {
////        return view('ImageUpload');
////    }
//
//    /**
//     * Store a newly created resource in storage.
//     */
//
//    public function uploadImages(Request $request)
//    {
//
//        $imageArray = array();
//
//        // file validation
//        $this->validate($request, [
//            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//        ]);
//
//        // if validation success
//        $uploadedImages = array();
//
//        if ($files = $request->file('image')) {
//
//            foreach ($files as $file) {
//
//                $name = time() . rand(111, 999) . '.' . $file->getClientOriginalExtension();
//
//                $destinationPath = public_path('images/apartments_images');
//
//                if ($file->move($destinationPath, $name)) {
//
//                    $images[] = $name;
//
//                    $uploadedImages[] = array(
//                        "image_name" => $name
//                    );
//
//                    $saveResult = upload::create(['image_name' => $name]);
//                }
//            }
//
////
//
//
//        }
//                    return response()->json($imageArray);
//
////        return redirect()->back()->with(compact('uploadedImages'));
//    }
//
//    /**
//     * Display the specified resource.
//     */
//    public function show(string $id)
//    {
//        //
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     */
//    public function edit(string $id)
//    {
//        $image = upload::find($id);
//        return view('updateimage', compact('image'));
//    }
//
//    /**
//     * Update the specified resource in storage.
//     */
//    public function update(Request $request, string $id)
//    {
//        $files = [];
//        if ($request->hasupload('filenames')) {
//
//            foreach ($request->file('filenames') as $file) {
//                $filename = time() . rand(1, 100) . '.' . $file->extension();
//                $file->move(public_path('files'), $filename);
//                $files[] = $filename;
//            }
//        }
//
//        $file = upload::find($id);
//        $file->filenames = $files;
//        $file->update();
//        return redirect('/image');
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     */
//    public function destroy(string $id)
//    {
//        $image = upload::find($id);
//        $image->delete();
//        return redirect('/image');
//    }
//
//
//    public function addProduct(Request $request)
//    {
//        // dd($request['images']);
//        $this->validate($request, [
//            'name' => 'required|string|max:255',
//            'description' => 'required|string|max:855',
//        ]);
//
//        $product = new upload();
//        $product->name = $request->name;
//        $product->description = $request->description;
//        $product->save();
//
//        foreach ($request->file('images') as $imagefile) { //image come from frontend was array like images[]
//            $image = new Image;
//            $path = $imagefile->store('/images/resource', ['disk' => 'my_files']);
//            $image->url = $path;
//            $image->product_id = $product->id;
//            $image->save();
//        }
//    }
//
//
//
//    // public function getdash(){
//    // 		$data = DB::table('record_group')->get();
//    // 		return view('dashboard.imagedash',compact('data'));
//    //return view('dashboard.card.index',compact('data'));
//    // $rdfn3_id = DB::table('bd_record_group')
//    // 						->select('id')
//    // 						->where('rg_id',$id)
//    // 						->where('bd_id',3)
//    // 						->first();
//    // }
//    public function create()
//    {
//        return view('gallery');
//    }
//
//    public function store(Request $request)
//    {
//        $this->validate($request, [
//            'image_name' => 'required',
//            'image_name.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
//        ]);
//
//        if($request->hasfile('image_name'))
//        {
//            foreach($request->file('image_name') as $image)
//            {
//                $name=$image->getClientOriginalName();
//                $image->move(public_path().'/images/', $name);
//                $data[] = $name;
//            }
//        }
//        $validatedData = $request->validate([
//            'image_name'=>'required',
////            'title' => 'required',
////            'description' => 'required',
//        ]);
//
//        upload::create($request->all());
//        $form= new upload();
//        $form->image_name=json_encode($data);
//
//
//        $form->save();
//        return back()->with('success', 'Your images has been successfully');
//    }

}
