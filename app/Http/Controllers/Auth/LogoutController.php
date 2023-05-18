<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
class LogoutController extends Controller
{
    //
    public function __invoke(Request $request)
    {
        auth()->guard()->logout();
        return response()->json(['message' => 'Logout success'], ResponseAlias::HTTP_OK);
    }
}
