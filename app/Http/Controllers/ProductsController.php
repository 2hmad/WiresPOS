<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductsController extends Controller
{
    public function get()
    {
        return Products::with(['store', 'category'])->get();
    }
    public function insert(Request $request)
    {
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
                'qunatity' => 1,
                'store_id' => $reqDecode['store'],
                'image' => $file_name
            ]);
        }
    }
    public function add_category(Request $request)
    {
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
    }
}
