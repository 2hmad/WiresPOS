<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductsController extends Controller
{
    public function get()
    {
        return Products::with(['store', 'category'])->orderBy('id', 'DESC')->get();
    }
    public function insert(Request $request)
    {
        $user = User::where('token', $request->header('token'))->first();
        if ($user->role == 'admin') {
            $validate = $request->validate([
                'thumbnail' => 'required|mimes:jpg,png,svg,jpeg|max:1000'
            ]);
            if ($validate) {
                $reqDecode = json_decode($request->data, true);
                $file_name = $reqDecode['productName'] . '.' . $request->thumbnail->getClientOriginalExtension();
                $file_path = $request->file('thumbnail')->storeAs('store-' . $reqDecode['store'] . "/products", $file_name, 'public');
                Products::updateOrCreate([
                    'product_name' => $reqDecode['productName'],
                    'product_details' => $reqDecode['productDetails'],
                    'price' => $reqDecode['productPrice'],
                    'category' => $reqDecode['category'],
                    'code' => $reqDecode['code'],
                    'quantity' => 1,
                    'store_id' => $reqDecode['store'],
                    'image' => $file_name
                ]);
            }
        } else {
            return response()->json(['alert' => 'permission denied'], 404);
        }
    }
    public function delete(Request $request)
    {
        $user = User::where('token', $request->header('token'))->first();
        if ($user->role == 'admin') {
            Products::where('id', $request->id)->delete();
        } else {
            return response()->json(['alert' => 'permission denied'], 404);
        }
    }
    public function add_category(Request $request)
    {
        $user = User::where('token', $request->header('token'))->first();
        if ($user->role == 'admin') {
            $validate = $request->validate([
                'image' => 'required|mimes:jpg,png,svg,jpeg|max:1000'
            ]);
            if ($validate) {
                $reqDecode = json_decode($request->data, true);
                $checkCat = Categories::where('category_name', $reqDecode['category_name'])->first();
                if ($checkCat == null) {
                    $file_name = $reqDecode['category_name'] . '.' . $request->image->getClientOriginalExtension();
                    $file_path = $request->file('image')->storeAs("/categories", $file_name, 'public');
                    Categories::create([
                        'category_name' => $reqDecode['category_name'],
                        'icon' => $file_name
                    ]);
                } else {
                    return response()->json(['alert' => 'added before'], 404);
                }
            }
        } else {
            return response()->json(['alert' => 'permission denied'], 404);
        }
    }
    public function edit_category(Request $request)
    {
        $user = User::where('token', $request->header('token'))->first();
        if ($user->role == 'admin') {
            Categories::where('id', $request->id)->update([
                'category_name' => $request->category_name
            ]);
        } else {
            return response()->json(['alert' => 'permission denied'], 404);
        }
    }
    public function delete_category(Request $request)
    {
        $user = User::where('token', $request->header('token'))->first();
        if ($user->role == 'admin') {
            Categories::where('id', $request->id)->delete();
            Products::where('category', $request->id)->delete();
        } else {
            return response()->json(['alert' => 'permission denied'], 404);
        }
    }
}
