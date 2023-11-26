<?php

namespace App\Http\Controllers\old_controllers;

use App\Models\TypeOfUser;

class TypeOfUserController extends Controller
{
public function all(){
    $type = TypeOfUser::all();
    return $this->success($type);
}
}
