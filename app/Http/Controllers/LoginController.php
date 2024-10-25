<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        //$credentials = $request->only('email', 'password');

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $temp = User::where('email', '=', $request->email)->first();
        if (!$temp) {
            return new JsonResponse(['message' => 'Periksa Kembali Username dan password anda'], 409);
        }
        if ($temp) {
            $pass = Hash::check($request->password, $temp->password);
            if (!$pass) {
                return new JsonResponse(['message' => 'Periksa Kembali Username dan password anda'], 409);
            }
        }
        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = User::find(auth()->user()->id);
        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }
}
