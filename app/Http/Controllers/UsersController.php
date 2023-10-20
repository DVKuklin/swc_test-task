<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function getUser() {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['success'=>false,'message'=>'Пользователь не найден'],404);
        }
        return response()->json(['success'=>true,'data'=>['name'=>$user->name, 'surname'=>$user->surname]],200);
    }

    public function userPage($id) {
        $user=User::where('id',$id)->select('name','surname','id','birthday')->first();
        return view('user',['user'=>$user]);
    }
}
