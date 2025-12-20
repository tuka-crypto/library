<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers\ResponseHelper;

class AuthController extends Controller
{
    function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:175|unique:users',
            'password' => 'required|min:6',
            'gender'=>'required|in:M,F',
            'phone'=>'required|digits:10',
            'avatar'=>'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);
        $user = User::create(
            $validated
        );
        $user->customer()->create([
            'gender'=>$validated['gender'],
            'phone'=>$validated['phone'],
            'avatar'=>$validated['avatar']??'download.png'
        ]);
        return ResponseHelper::success(
            [ 'user' => $user->load('customer'),'token' => $user->createToken("Api Token")->plainTextToken], "user created successfully",
        );
    }
    function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password,  $user->password)) {
            return ResponseHelper::success("user logged successfully" , [
                'user' => $user,
                'token' => $user->createToken("Api Token")->plainTextToken,
            ]);
        }
        else
            return ResponseHelper::error("invalid credential");
    }

    function logout(){
        $token = Auth::user()->currentAccessToken()->delete();
        return ResponseHelper::success("user logout successfully");
    }
}
