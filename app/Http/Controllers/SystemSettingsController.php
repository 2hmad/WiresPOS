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
}
