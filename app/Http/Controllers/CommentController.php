<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function add(Request $request){
        $fields = [
            'comment'=>"required",
        ];
        $valid = Validator::make($request->all(),$fields);
        if($valid->fails()){
            $msg = $valid->messages()->first();
            $res = [
                'status'=>false,
                'msg'=>$msg,
                'data'=>null
            ];
            return response()->json($res,404);
        }
        $comment =  $request->comment;
        $data = comment::create([
            'comment'=>$comment,
        ]);
        $res = [
            'status'=>true,
            'msg'=>"success",
            'data'=>$data
        ];
        return response()->json($res,200);
    }

    public function all(){
        $comments= comment::all();
        $commentResource  = CommentResource::collection($comments);

        return $this->success($commentResource);

    }
}
