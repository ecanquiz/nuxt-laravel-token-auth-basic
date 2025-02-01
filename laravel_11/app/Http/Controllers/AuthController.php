<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Fetch user information
    public function index(Request $request){
        return $request->user();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|string',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|confirmed|min:5|max:255'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    // Authenticate user and generate token
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'message' => 'Bad login credientials'
            ], 401);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    // Logout and delete tokens
    public function destroy(){
        auth()->user()->tokens()->delete();
        return [
            'status' => 201,
            'message' => 'Logged Out'
        ];

        /*return response()->json([
            'message' => 'Logged Out!',
        ], 201);*/
    }
}
