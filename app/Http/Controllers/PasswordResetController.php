<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use App\Models\PasswordResetToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    public function send_reset_mail(Request $request){

        $validate = $request->validate([
            'email' => 'required|email',
        ]); 

        $email = $request->email;

        $user = User::where('email', $email)->first();

        if(!$user){
            return response([
                'type'=> 'error',
                'message' => 'There are no user here.',
                'status' => 'failed'
            ], 422);
        }

        $resetmail = PasswordResetToken::where('email', $email)->first();
        if ($resetmail) {
            $resetmail->delete();
        }

        $token = Str::random(41);
        PasswordResetToken::create([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $username = $user->name;

        Mail::send('reset', ['token' => $token, 'username' => $username], function (Message $message)use($email) {
            $message->subject('Your password reset request');
            $message->to($email);
        });

        return response([
                'type'=> 'OK',
                'message' => 'Your reset mail has been sent.',
                'status' => 'success'
        ], 200);

        $expiredTokens = PasswordResetToken::where('created_at', '<', Carbon::now()->subMinutes(2))->get();

        foreach ($expiredTokens as $token) {
            $token->delete();
        }
    }

    public function reset_password(Request $request , $token){
        
        $token = PasswordResetToken::where('token',$token)->first();

        if(!$token){
            return response([
                    'type'=> 'error',
                    'message' => 'Your password reset time expier.',
                    'status' => 'failed'
            ], 422);
        }
        $validate = $request->validate([
            'password' => 'required',
        ]);

        $email = $token->email;

        $user = User::where('email',$email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        $resetmail = PasswordResetToken::where('email', $email)->first();
        if ($resetmail) {
            $resetmail->delete();
        }

        return response([
                'type'=> 'OK',
                'message' => 'Your password has been reset.',
                'status' => 'success'
        ], 200);
    }
}
