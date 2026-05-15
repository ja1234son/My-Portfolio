<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request):JsonResponse{
      $request->validate([
        'email' => 'required|email',
        'password' => 'required'
      ]);

      $user = User::where('email',$request->email)->first();
      if (!$user || !Hash::check($request->password, $user->password)) {
         return response()->json([
            'message' => 'The Provided User Credentials are Wrong!!'
         ],401);
      }
      $token = $user->createToken($user->name.'Auth-Token')->plainTextToken;
      return response()->json([
        'message' => 'Login Successfull!',
        'token_type' => 'Bearer',
        'token' => $token
      ]);

    }

    public function registration(Request $request){
      $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required'
      ]);

      $user =  User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password
      ]);

      if ($user) {
        
         $token = $user->createToken($user->name.'Auth-Token')->plainTextToken;
        return response()->json([
            'message' => 'Registration Success!!',
            'token_type' => 'Bearer',
            'token' => $token
        ],201);
      }
      return response()->json([
        'message' => 'Something Went Wrong During Resgistration!',
      ],500);
    }

    public function logout(Request $request){
        $user = User::where('id',$request->user()->id)->first();
        if ($user) {
            $user->tokens()->delete();
            return response()->json([
            'message' => 'Logging Out Success!!',
        ],200);
        }else {
             return response()->json([
        'message' => 'User Not Found',
      ],404);
        }
    }
}
