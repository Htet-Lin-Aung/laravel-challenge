<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {    
        if (!Auth::attempt($request->only('email', 'password'))){
            return response()->json(['status' => Response::HTTP_UNAUTHORIZED,'message' => 'Invalid credentials'],Response::HTTP_UNAUTHORIZED);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        
        $data = new LoginResource($user);
        
        return response()->json([
            'data' => $data,
        ],Response::HTTP_OK);
    }
}