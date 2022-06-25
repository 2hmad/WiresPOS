<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $user = User::where('token', $request->header('token'))->first();
        return Products::where([
            ['store_id', '=', $user->store],
            ['product_name', 'LIKE', '%' . $request->keyword . '%']
        ])->get();
    }
}
