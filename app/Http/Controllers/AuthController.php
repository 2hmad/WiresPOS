<?php

namespace App\Http\Controllers;

use App\Models\Branches;
use App\Models\Stores;
use App\Models\SystemSettings;
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
                'business_type' => $request->business_type,
                'plan' => 'free'
            ]);
            $getStore = Stores::where('store_name', $request->email . "'s store")->first();
            SystemSettings::create([
                'store_id' => $getStore->id,
                'tax_rate' => 0,
                'service_rate' => 0,
                'currency' => "usd"
            ]);
            Branches::create([
                'name' => $getStore->store_name,
                'address' => $getStore->address,
                'phone' => $getStore->phone,
                'store_id' => $getStore->id
            ]);
            $getBranch = Branches::where('name', $getStore->store_name)->first();
            User::create([
                'full_name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => str_replace(' ', '', $request->phone),
                'store' => $getStore->id,
                'branch' => $getBranch->id,
                'role' => 'admin',
                'token' => md5(time())
            ]);

            return User::where("email", '=', $request->email)->first();
        } else {
            return response()->json(['alert' => "Email already registered"], 404);
        }
    }
}
