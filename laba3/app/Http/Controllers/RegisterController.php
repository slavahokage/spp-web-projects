<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $name = $request->input('name');
        $password = $request->input("password");
        $email = $request->input("email");

        try {
            User::create([
                'name' => $name,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'email' => $email
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => 'Can\'t register new user'
            ]);
        }

        return response()->json([
            'status' => 'Successfully created'
        ]);
    }
}
