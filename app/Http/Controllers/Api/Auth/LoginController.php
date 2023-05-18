<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['the credentials you entered are incorrect.']
            ]);
        }
//        if (!auth()->guard()->attempt($request->only(['email', 'password']))) {
//            throw ValidationException::withMessages([
//                'email' => ['the credentials you entered are incorrect.']
//            ]);
//        }
//        return response()->json(['message' => 'login success', 'user' => auth()->user()], ResponseAlias::HTTP_OK);
        return response()->json([
            'user' => $user,
            'message' => 'Login success',
            'token' => $user->createToken('laravel_api_token')->plainTextToken
        ]);
    }
}
