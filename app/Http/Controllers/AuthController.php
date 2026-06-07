<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Models\StudentProfile;
use App\Models\CompanyProfile;


class AuthController extends Controller
{
    public function register(Request $request){
       $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
            'role' => 'required|in:student,company',

       ]);

     
       $user = User::Create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'], 

       ]);

       if($user->role === 'student'){
          StudentProfile::create([
               'user_id' => $user->id 
          ]);

       }

       if($user->role === 'company'){
          CompanyProfile::create([
               'user_id' => $user->id
          ]);
       }

       return response()->json([
            'message' => ' User registered successfuly ',
            'user' => $user
       ], 201 );


    }

    public function login(Request $request){
          $validated = $request->validate([
               'email' => 'required|email' ,
               'password' => 'required'
          ]);

          $user = User::where('email' , $validated['email'])->first();

          if (!$user || !Hash::check($validated['password'] , $user->password)) {
               return response()->json ([
                    'message' => 'Invalid Login '
               ] , 401 );
          }

          return response()->json ([
               'login' => 'Login Successful' ,
               'user' => $user
          ] , 200 );

    }
}
