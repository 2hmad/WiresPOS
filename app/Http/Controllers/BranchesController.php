<?php

namespace App\Http\Controllers;

use App\Models\Branches;
use App\Models\User;
use Illuminate\Http\Request;

class BranchesController extends Controller
{
    public function add(Request $request)
    {
        $check = Branches::where('name', $request->branch_name)->first();
        $user = User::where('token', $request->header('token'))->first();
        if ($check == null) {
            Branches::create([
                'name' => $request->branch_name,
                'address' => $request->branch_name,
                'phone' => $request->branch_name,
                'store_id' => $user->store
            ]);
        } else {
            return response()->json(['alert' => 'Branch added before'], 404);
        }
    }
}
