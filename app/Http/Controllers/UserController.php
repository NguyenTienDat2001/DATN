<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    //
    public function updateProfile(Request $request)
    {
        $id = $request->get('user_id');
        $name = $request->get('name');
        $sex = $request->get('sex');
        $phone = $request->get('phone');
        $address = $request->get('address');
        // $dob = $request->get('dob');
        Log::info($request);
        User::where('id', $id)->update(
            [
                'name' => $name,
                'sex' => $sex,
                'phone_number' => $phone,
                'address' => $address,
            ]
        );
        return response()->json(['message' => 'sucessfully'], 200);
    }

    public function getInfor($id){
        $profile = User::where('id', $id)->first();
        return response()->json(['message' => 'sucessfully', 'data' => $profile], 200);
    }
    public function getUser(){
        $users = User::where('role', '!=', 0)->get();
        foreach($users as $user){
            if($user->role == 2){
                $user->rolename = 'user';
            }
            else {
                $user->rolename = 'subadmin';
            }
        }
        return response()->json(['message' => 'sucessfully', 'users' => $users], 200);
    }
}
