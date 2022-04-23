<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function checkUser(Request $request)
    {
        $checkUser = User::where("email", $request->email)->first();
        if ($checkUser !== null) {
            if (Hash::check($request->password, $checkUser->password)) {
                return $checkUser;
            } else {
                return response()->json("Password is incorrect", 404);
            }
        } else {
            return response()->json("Email not found", 404);
        }
    }
}
