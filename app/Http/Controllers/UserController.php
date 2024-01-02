<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $user = User::all();
        return $user;
    }
    public function user_register(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        // Checking username availability
        $usernameExists = User::where('username', $request->username)->exists();
        if ($usernameExists) {
            return response([
                'type' => 'error',
                'message' => 'The username is already in use!',
                'status' => 'failed'
            ], 422);
        }

        // Inserting registration data
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Creating a token
        $token = $user->createToken($request->email)->plainTextToken;

        if (!$user) {
            return response([
                'type'=> 'error',
                'message' => 'Unable to submit data.',
                'status' => 'failed'
            ], 422);
        }

        return response([
            'type'=> 'OK',
            'message' => 'User data added successfully.',
            'status' => 'success',
            'Token' => $token
        ], 200);
    }


    public function user_login(Request $request){
        
        $validate = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken($user->email)->plainTextToken;
            return response([
                'type'=> 'OK',
                'message' => 'User Login successfull.',
                'status' => 'success',
                'Token'=>$token
            ],200);
        }
        return response([
            'type'=> 'error',
            'message' => 'User not.',
            'status' => 'success',
            'Token'=>$token
        ],200);
    }

    public function user_logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'type' => 'OK',
            'message' => 'User Logout successful.',
            'status' => 'success',
        ], 200);
    }
    public function user_change_password(Request $request)
    {
        $validate = $request->validate([
            'password' => 'required|confirmed'
        ]);
        $loggedUser = auth()->user();
        $loggedUser->password = Hash::make($request->password);
        $loggedUser->save();
        return response([
            'type' => 'OK',
            'message' => 'User password changed successful.',
            'status' => 'success',
        ], 200);
    }

}
