<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Catch_;

class RegisterController extends Controller
{
    //
    function register(Request $request){

        //dd($request);

      //vlaidate incoming request
      $validate = Validator::make($request->all() ,[
        'name' => "required|string|max:255",
            'email' => "required|string|max:255|email|unique:users",
            'password' => "required|string|min:5|confirmed",

      ]);

      //return errors if validation failed
      if($validate->fails()){
        return response()->json([
            'status' =>'error',
            'message'=>'Validation fails',
            'errors' => $validate->errors()

        ],422);
      }

      try{
        ///create user
        $user = User::create([
            'name' =>$request->name,
            'email' =>$request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('auth-toen')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => 'User register Successfully',
                'user' => $user,
                'token' =>$token

            ], 201
        );
    }catch(\Exception $e){
            return response()->json([
                'status' => 'errors',
                'message' => 'AN error occured when register',
                'error' => $e->getMessage(),

            ], 500);
    }

    }
}
