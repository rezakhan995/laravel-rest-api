<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function generateToken(Request $request)
    {
        $username = $request->email;
        $password = $request->password;
        if (Auth::attempt(["email" => $username, "password" => $password])) {
            return Auth::user();
        }
    }
}
