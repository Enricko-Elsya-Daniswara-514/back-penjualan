<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        //$credentials = $request->only('email', 'password');

        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

          //request credentials
        $credentials = $request->only('username', 'password');

        //auth failed
        if (!$token = JWTAuth::attempt($credentials, ['exp' => Carbon::now()->addDays(7)->timestamp])) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau Password Anda salah'
            ], 401);
        }

        $user = User::find(auth()->user()->id);
        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => $user
        ]);
    }
}
