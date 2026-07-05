<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileApiController extends Controller
{

    // GET /api/profile
    public function profile()
    {
        return response()->json([
            'success' => true,
            'data' => Auth::user()
        ]);
    }

    // PUT /api/profile
    public function update(Request $request)
    {

        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,'.Auth::id()
        ]);

        $user = Auth::user();

        $user->nama = $request->nama;
        $user->email = strtolower($request->email);

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui',
            'data' => $user
        ]);

    }

}