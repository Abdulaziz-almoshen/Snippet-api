<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use http\Env\Response;
use Illuminate\Http\Request;

class SigninController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        if (!$token = auth()->attempt($request->only('email','password'))){
            return response()->json([
                'errors' => [
                    'email' => ['email not found'],402
                    ]
            ]);
        };
        return response()->json([
            'data' => compact('token')
        ]);
    }
}
