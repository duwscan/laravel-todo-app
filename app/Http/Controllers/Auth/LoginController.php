<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;


class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
//        $user = User::where('email', $request->email)->first();
//
//        if (!$user || !Hash::check($request->password, $user->password)) {
//            throw ValidationException::withMessages([
//                'email' => ['the credentials you entered are incorrect.']
//            ]);
//        }
        if (!auth()->guard()->attempt($request->only(['email', 'password']))) {
            throw ValidationException::withMessages([
                'email' => ['the credentials you entered are incorrect.']
            ]);
        }
        return response()->json(['message' => 'login success', 'user' => auth()->user()], ResponseAlias::HTTP_OK);
    }
}
