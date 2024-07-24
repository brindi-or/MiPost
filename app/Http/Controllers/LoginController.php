<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // The `Auth::attempt` method attempts to authenticate the user based on the given credentials. It takes an array of key-value pairs where the keys are the column names in the `users` table and the values are the values to be checked against the corresponding columns. If the authentication is successful, it returns `true`, otherwise `false`.
        //
        // In this case, the `$credentials` array contains the email and password values provided in the request. The `Auth::attempt` method checks if there is a user with the given email in the `users` table and if the password matches the hashed password stored in the `password` column. If the authentication is successful, it logs the user in by creating a session for the user.
        //
        // If the authentication fails, it returns `false` and the `if` condition will be evaluated to `false`.
        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken('auth-token')->plainTextToken;
            // dd(auth()->user(), Auth::user(), $request);
            $user = Auth::user();
            return response()->json(['token' => $token,'user' =>$user]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }
    }

