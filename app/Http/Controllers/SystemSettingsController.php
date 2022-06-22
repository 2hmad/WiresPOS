<?php

namespace App\Http\Controllers;

use App\Models\SystemSettings;
use App\Models\User;
use Illuminate\Http\Request;

class SystemSettingsController extends Controller
{
    public function get(Request $request)
    {
        $user = User::where('token', $request->header('token'))->first();
        return SystemSettings::where('store_id', $user->store)->first();
    }
    public function update(Request $request)
    {
        $user = User::where('token', $request->header('token'))->first();
        if ($user->role == 'admin') {
            $checkSettings = SystemSettings::where('store_id', $user->store)->first();
            if ($checkSettings == null) {
                SystemSettings::create([
                    'store_id' => $user->store,
                    'tax_rate' => $request->tax,
                    "currency" => $request->currency
                ]);
            } else {
                SystemSettings::where('store_id', $user->store)->update([
                    'tax_rate' => $request->tax,
                    "currency" => $request->currency
                ]);
            }
        } else {
            return response()->json(['alert' => 'permission denied'], 404);
        }
    }
}
