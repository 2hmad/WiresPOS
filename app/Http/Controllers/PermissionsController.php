<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PermissionsController extends Controller
{
    public function get_users(Request $request)
    {
        $user = User::where('token', $request->header('token'))->first();
        if ($user->role == 'admin') {
            return User::get();
        } else {
            return response()->json(['alert' => 'permission denied'], 404);
        }
    }
    public function delete_user(Request $request)
    {
        $user = User::where('token', $request->header('token'))->first();
        if ($user->role == 'admin') {
            return User::where('id', $request->id)->delete();
        } else {
            return response()->json(['alert' => 'permission denied'], 404);
        }
    }
    public function add_user(Request $request)
    {
        $user = User::where('token', $request->header('token'))->first();
        if ($user->role == 'admin') {
            $check = User::where('email', $request->email)->first();
            if ($check == null) {
                User::create([
                    'full_name' => $request->full_name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'phone' => $request->phone,
                    'store' => $user->store,
                    'branch' => $request->branch,
                    'role' => $request->role,
                    'token' => md5(time())
                ]);
            } else {
                return response()->json(['alert' => 'user added before'], 404);
            }
        } else {
            return response()->json(['alert' => 'permission denied'], 404);
        }
    }
}
