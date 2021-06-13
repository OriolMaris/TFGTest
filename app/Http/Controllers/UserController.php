<?php

namespace App\Http\Controllers;

use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    //
    public function index(){
        return User::all();
    }

    public function register(Request $request){
        $fileds = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);
        $user = User::create([
            'name' => $fileds['name'],
            'email' => $fileds['email'],
            'password' => bcrypt($fileds['password']),

        ]);

        $token = $user->createToken('myappToken')->plainTextToken;
        
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request){
        $fileds = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        
        // check
        $user = User::where('email', $fileds['email'])->first();
        
        // check
        if (!$user || !Hash::check($fileds['password'], $user->password)) {
            return response([
                'message' => 'bad creds'
            ], 401);
        }
        $token = $user->createToken('myappToken')->plainTextToken;
        
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    public function favAnimals(){
        return [
            'message' => 'fav animals'
        ];
    }
}
