<?php

namespace App\Http\Controllers;

use App\Models\Ingredients;
use App\Models\User;
use Illuminate\Http\Request;

class IngredientsController extends Controller
{
    public function get(Request $request)
    {
        $user = User::where('token', $request->header('token'))->first();
        return Ingredients::where([
            ['product_id', '=', $request->product_id],
            ['store_id', '=', $user->store]
        ])->first();
    }
    public function getAll(Request $request)
    {
        $user = User::where('token', $request->header('token'))->first();
        return Ingredients::where('store_id', $user->store)->with('product')->get();
    }
    public function add(Request $request)
    {
        $user = User::where('token', $request->header('token'))->first();
        Ingredients::create([
            'store_id' => $user->id,
            'product_id' => $request->product_id,
            "ingredients" => json_encode($request->ingredients)
        ]);
    }
    public function delete(Request $request)
    {
        Ingredients::where('id', $request->id)->delete();
    }
}
