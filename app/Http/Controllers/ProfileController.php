<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        if ($request->pic !== null) {
            $validated = $request->validate([
                'pic' => 'mimes:jpg,png,jpeg'
            ]);
            if ($validated) {
                $reqDecode = json_decode($request->data, true);
                $file_name = $request->header('token') . '.' . $request->pic->getClientOriginalExtension();
                $file_path = $request->file('pic')->storeAs('users', $file_name, 'public');
                User::where('token', $request->header('token'))->update([
                    'full_name' => $reqDecode['full_name'],
                    'email' => $reqDecode['email'],
                    'phone' => $reqDecode['phone'],
                    'pic' => $file_name
                ]);
            }
        } else {
            User::where('token', $request->header('token'))->update([
                'full_name' => $request->fullName,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
        }
    }
    public function updatePassword(Request $request)
    {
        $checkPassword = User::where('token', $request->header('token'))->first();
        if (Hash::check($request->old_password, $checkPassword->password)) {
            User::where('token', $request->header('token'))->update([
                'password' => Hash::make($request->new_password)
            ]);
        } else {
            return response()->json(["alert" => "Old password is incorrect"], 404);
        }
    }
}
