<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use \Firebase\JWT\JWT;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $password = $request->input("password");
        $email = $request->input("email");

        $user = User::where('email', $email)->first();

        if ($user == null) {
            return response()->json([
                'error' => 'Can\'t login',
            ]);
        }

        if (password_verify($password, $user->password)) {
            $key = env('APP_KEY', "key");

            $payload = array(
                'email' => $email,
                'name' => $user->name,
            );

            $jwt = JWT::encode($payload, $key);

            header("Set-Cookie: token=".$jwt."; httpOnly");
            return response()->json([
                'status' => 'Successfully login',
            ]);

        } else {
            return response()->json([
                'status' => 'Can\'t login',
            ]);
        }
    }
}
