<?php

namespace App\Http\Controllers;

use App\AuthInterface;
use App\Models\Student;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Nette\Utils\Random;

class StudentAuthController extends Controller implements AuthInterface
{
    use ImageUpload;
    // Registration
    public function register(Request $request)
    {
        if($request->role == 'student') {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users',
                'password' => 'required|min:5|confirmed, Password::defaults()',
                'password_confirmation' => 'required',
                'firstname' => 'required|string',
                'othername' => 'required|string',
                'lastname' => 'required|string',
                'subclass_id' => 'required|integer',
                'gender' => 'required|string',
                'profile' => 'required|mimes:jpg,png,jpeg|max:25000'
            ]);
            
            if($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            
            $imagePath = $this->upload($request);
            
            // Create the new Student record
            $user = Student::create([
                'email' => $request->email,
                'password' => Hash::make($request->password), // Encrypt password
                'firstname' => $request->firstname,
                'othername' => $request->othername,
                'lastname' => $request->lastname,
                'subclass_id' => $request->subclass_id,
                'verify_token' => Random::generate(5, '0-9'),
                'gender' => $request->gender,
                'profile' => $imagePath,
            ]);

            $token = $user->createToken('access-token')->plainTextToken;

            //send Email
            $data = [
                'user' => $user,
                'type' => 'verify'
            ];
            // SendEmail::dispatch($data);

            // Return the created user as a response
            return response()->json([
                'token' => $token,
                'response' => 'User Created Successfully', 
                'user' => $user
            ], 201);
            
            

            return response()->json(['token' => $token, 'user' => $user], 201);        }
    }

    // Login
    public function login(Request $request)
    {
        
    }
}
