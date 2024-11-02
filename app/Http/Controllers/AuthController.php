<?php

namespace App\Http\Controllers;

use App\AuthInterface;
use App\Models\Student;
use Illuminate\Http\Request;

class AuthController extends Controller implements AuthInterface
{
    // Registration
    public function register(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|unique:users',
                'password' => 'required|min:5',
            ]);

            if($request->role == 'admin') {

            }

            if($request->role == 'teacher') {

            }

            if($request->role == 'student') {
                $user = new Student();
            }
            // Create a new user or perform other actions
            $user = new User();
            $user->email = $request->email;
            // $user->referred_by = Random::generate(7); // Expecting an integer (a user's ID)
            $user->password = Hash::make($request->password);
            $user->lga_id = 1;
            $user->verify_token = Random::generate(5,'0-9');
            $user->save();

            Auth::login($user);

            $token = $user->createToken('access-token')->plainTextToken;

            //send Email
            $data = [
                'user' => $user,
                'type' => 'verify'
            ];
            SendEmail::dispatch($data);

            return response()->json(['token' => $token, 'user' => $user], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    // Login
    public function login(Request $request)
    {
        
    }
}
