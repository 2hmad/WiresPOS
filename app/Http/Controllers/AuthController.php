<?php

namespace App\Http\Controllers;

use App\Models\Stores;
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
                return response()->json(['alert' => "Password is incorrect"], 404);
            }
        } else {
            return response()->json(['alert' => "Email not found"], 404);
        }
    }
    public function register(Request $request)
    {
        $checkUser = User::where([
            ["email", '=', $request->email],
            ["phone", '=', str_replace(' ', '', $request->phone)],
        ])->first();
        if ($checkUser == null) {
            Stores::create([
                'store_name' => $request->email . "'s store",
                'plan' => 'free'
            ]);
            $getStore = Stores::where('store_name', $request->email . "'s store")->first();
            User::create([
                'full_name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => str_replace(' ', '', $request->phone),
                'store' => $getStore->id,
                'branch' => '',
                'role' => 'admin',
                'token' => md5(time())
            ]);

            return User::where("email", '=', $request->email)->first();
        } else {
            return response()->json(['alert' => "Email already registered"], 404);
        }
    }
}
