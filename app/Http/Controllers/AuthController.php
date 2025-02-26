<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
       $user= User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        // $token=$user->createToken('token')->plainTextToken;
        return response()->json([
            'data'=>$user,
            // 'token'=>$token,
            'message'=>"Registered Successfully"
        ],201);
    }
    public function loginUser(Request $request){
      if(Auth::attempt([
        "email"=>$request->email,
        "password"=>$request->password
        
        ]))
        $user=Auth::user();
        $token=$user->createToken('token')->plainTextToken;
        return response()->json([
            'token'=>$token,
            'data'=>$user,
            'message'=>"login Successfully"
        ],201);
    }
}
