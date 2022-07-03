<?php

namespace App\Http\Controllers;

use App\Models\Tables;
use App\Models\User;
use Illuminate\Http\Request;

class TablesController extends Controller
{
    public function get(Request $request)
    {
        $user = User::where('token', $request->header('token'))->first();
        return Tables::where('store_id', $user->store)->get();
    }
    public function add(Request $request)
    {
        $user = User::where('token', $request->header('token'))->first();
        if ($user->role == 'admin') {
            $checkTable = Tables::where([
                ['table_number', '=', $request->table_number],
                ['store_id', '=', $user->store],
            ])->first();
            if ($checkTable == null) {
                Tables::create([
                    'store_id' => $user->store,
                    'table_number' => $request->table_number,
                    'seats_number' => $request->seats_number,
                ]);
            } else {
                return response()->json(['alert' => 'added before'], 404);
            }
        }
    }
    public function delete(Request $request)
    {
        $user = User::where('token', $request->header('token'))->first();
        if ($user->role == 'admin') {
            $checkTable = Tables::where([
                ['table_number', '=', $request->id],
                ['store_id', '=', $user->store],
            ])->first();
            if ($checkTable !== null) {
                Tables::where('table_number', '=', $request->id)->delete();
            } else {
                return response()->json(['alert' => 'permission denied'], 404);
            }
        }
    }
}
