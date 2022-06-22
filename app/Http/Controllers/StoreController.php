<?php

namespace App\Http\Controllers;

use App\Models\Stores;
use App\Models\User;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function get(Request $request)
    {
        $user = User::where('token', $request->header('token'))->first();
        if ($user->role == 'admin') {
            return Stores::where('id', $user->store)->first();
        } else {
            return response()->json(['alert' => 'permission denied'], 404);
        }
    }
}
