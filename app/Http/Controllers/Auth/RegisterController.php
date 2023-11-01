<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request){
        $user = User::where([
            'email' => $request->get('email'),
        ])->first();

        if ($user) {
            return response()->json(['message' => 'error', 'content' => 'existed'], 400);
        } else {
            User::create([
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
            ]);
            return response()->json(['message' => 'success'], 200);
        }
    }
}
