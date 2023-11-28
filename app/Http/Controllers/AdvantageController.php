<?php
//vendor/fruitcake/laravel-cors/src/HandleCors.php
namespace App\Http\Controllers;
//vendor/asm89/stack-cors/src/CorsService.phpvendor/asm89/stack-cors/src/CorsService.php
use App\Http\Resources\AdvantageResource;
use App\Models\Advantage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdvantageController extends Controller
{
    public function add(Request $request): \Illuminate\Http\JsonResponse
    {
        $fields = [
            'adv_name'=>"required",
            'icon_image'=>"required|image|mimes:jpeg,png,jpg,gif|max:2048",
            'category_of_icon' => 'required',

        ];
        $valid = Validator::make($request->all(),$fields);
        if($valid->fails()){
            $msg = $valid->messages()->first();
            return $this->fail($msg);
        }
        $adv_name =  $request->adv_name;
        $icon_image = $request->file('icon_image');
        $categoryOfIcon = $request->category_of_icon;

        $imageName = $icon_image->getClientOriginalName() ;
////
        $dir = "images/icons/$categoryOfIcon";
////        $fulldir = "/home/akram/public_html/" . $dir;
//
//        //for Cpanel
//        //$icon->move($fulldir, $name);
//
//        //for Localhost
        $icon_image->move($dir,$imageName);
        $path = $dir . '/'
            .
            $imageName;
        $quitUrl = 'https://weenbalaqee.com/' . $path;


////
//        $path = $dir . '/' . $name;
//        $data = url($path);
//        $advantage = $request->icon;
//      $advantage->update(['icon' => $path]);
//        $advantage = url($advantage->icon);
//        $advantage['token'] = $request->bearerToken();//SEE this
        $dataOfAdv = Advantage::create([
            'adv_name'=>$adv_name,
            'icon'=>$quitUrl,
        ]);
        return $this->success($dataOfAdv);

    }
    public function all(){
        $advantages = Advantage::all();
        $advantagesResource  = AdvantageResource::collection($advantages);

        return $this->success($advantagesResource);

    }


}
