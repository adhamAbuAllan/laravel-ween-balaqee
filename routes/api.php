<?php

use App\Http\Controllers\AdvantageController;
use App\Http\Controllers\ApartmentAdvantageController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\ApartmentTestController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CityTestController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\TypeOfApartmentController;
use App\Http\Controllers\TypeOfUserController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\uploadController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/user/register', [UserController::class,'register']);
Route::post('/user/login', [UserController::class,'login']);
Route::post('/user/index', [UserController::class,'index']);
Route::post('/user/all', [UserController::class,'all']);
Route::post('/apartment/add', [ApartmentController::class,'add'])->middleware('auth:sanctum');
Route::post('/apartment/one', [ApartmentController::class,'one']);
//Route::get('/apartment/{id}', [ApartmentController::class,'get_apartment_info']);
Route::post('/apartment/update', [ApartmentController::class,'update'])->middleware('auth:sanctum');
Route::post('/apartment/delete', [ApartmentController::class,'delete'])->middleware('auth:sanctum');
Route::get('/apartment/all', [ApartmentController::class,'all']);
Route::get('/universities/all',[UniversityController::class,'all']);
Route::post('/universities/add',[UniversityController::class,'add']);
Route::get('/typeOfUser/all',[TypeOfUserController::class,'all']);
Route::get('/typeOfUser/add',[TypeOfUserController::class,'add']);
Route::Post('/city/add',[CityController::class,'add']);
Route::get('/city/all',[CityController::class,'all']);
Route::get('/typeOfApartment/all',[TypeOfApartmentController::class,'all']);
Route::POST('/typeOfApartment/add',[TypeOfApartmentController::class,'add']);
Route::POST('/advantages/add',[AdvantageController::class,'add']);
Route::get('/advantages/all',[AdvantageController::class,'all']);
Route::get('/apartment_advantage/insertAdvInApartment3',[ApartmentAdvantageController::class,'insertAdvInApartment3']);
Route::post('/apartment_advantage/show/{id}',[ApartmentAdvantageController::class,'show']);
Route::post('/apartment_advantage/showAdvantages',[ApartmentAdvantageController::class,'showAdvantages']);
Route::post('/apartment_advantage/getAdvantagesForApartment',[ApartmentAdvantageController::class,'getAdvantagesForApartment']);

//Route::get('/apartments/show',[ApartmentController::class,'show']);

//Route::get('/apartmentTest/all',[ApartmentTestController::class,'all']);
//Route::post('/apartmentTest/add',[ApartmentTestController::class,'add']);
//Route::post('/cityTest/add',[CityTestController::class,'add']);
//Route::get('/cityTest/all',[CityTestController::class,'all']);
Route::post('/booking/add',[BookingController::class,'add'])->middleware('auth:sanctum');
Route::get('/booking/all',[BookingController::class,'all']);
Route::get('/comment/all',[CommentController::class,'all']);
Route::post('/comment/add',[CommentController::class,'add']);
Route::post('/create_random_password/add',[UserController::class,'createRandomPasswordToUser']);


///for testing

//Route::post('/photo/uploadImages',[PhotoController::class,'uploadImages']);
Route::post('/photo/add',[PhotoController::class,'addImages']);


//Route::get('/photo/show',[PhotoController::class,'showImages']);
Route::get('/photo/{apartment_id}',[PhotoController::class,'showImages']);

Route::post('/upload/uploads',[uploadController::class,'store']);
Route::get('/upload/index',[uploadController::class,'index']);
Route::post('/upload/edit',[uploadController::class,'edit']);
Route::post('/upload/create',[uploadController::class,'create']);
Route::post('/upload/store',[uploadController::class,'store']);
Route::get('/upload/showImages',[uploadController::class,'showImage']);
Route::post('/upload/addImagesPublicDir',[uploadController::class,'addImages']);
//Route::get('/boolean/all',[BooleanController::class,'all']);
//Route::get('/boolean/add',[BooleanController::class,'add']);

