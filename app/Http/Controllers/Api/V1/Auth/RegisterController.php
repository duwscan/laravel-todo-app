<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request)
    {
        $user = User::create($request->getData());
        return response()->json([
            'user' => $user,
            'message' => 'Signup success',
            'token' => $user->createToken('laravel_api_token')->plainTextToken
        ]);
    }
}
