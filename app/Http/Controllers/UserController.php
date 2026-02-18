<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function register(Request $req){
    $emailExists = User::where('email', $req->email)->first();
    if($emailExists){
        return response()->json([
            "user" => null,
            "message" => "Email already exists"
        ], 409);
    }
        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->user_role = 'user';
        $user->save();
        return response()->json($user, 201);
    }

function login(Request $req){

    $user = User::where('email', $req->email)->first();
    if(!$user || !Hash::check($req->password, $user->password)){
        return response()->json([
            "success" => false,
            "message" => "Email or password is not correct"
        ], 401);
    }
    return response()->json([
        "success" => true,
        "message" => "Login successful",
        "user" => $user
    ], 200);
}
}
