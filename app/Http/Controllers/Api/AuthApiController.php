<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $user = User::where('email',$request->email)->first();

        if(!$user || !Hash::check($request->password,$user->password)){
            return response()->json([
                'success'=>false,
                'message'=>'Email atau password salah'
            ],401);
        }

        $token = $user->createToken('flutter')->plainTextToken;

        return response()->json([
            'success'=>true,
            'message'=>'Login berhasil',
            'token'=>$token,
            'user'=>$user
        ]);
    }

    public function register(Request $request)
    {

        $request->validate([
            'nama'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6'
        ]);

        $user = User::create([
            'nama'=>$request->nama,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>'user'
        ]);

        return response()->json([
            'success'=>true,
            'message'=>'Registrasi berhasil',
            'user'=>$user
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success'=>true,
            'message'=>'Logout berhasil'
        ]);
    }

}