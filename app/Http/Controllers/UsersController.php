<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function getUser() {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['success'=>false,'message'=>'Пользователь не найден'],404);
        }
        return response()->json(['success'=>true,'data'=>['name'=>$user->name, 'surname'=>$user->surname]],200);
    }
}
