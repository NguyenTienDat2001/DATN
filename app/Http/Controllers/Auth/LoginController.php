<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login( Request $request ){
        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt($credentials)) {
            return response()->json(['role' => Auth::user()->role, 'message' => 'success', 'user' => Auth::user()], 200);
        }

        return response()->json(['message' => 'error'] , 401);
    }

}
