<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductsController extends Controller
{
    public function get()
    {
        return Products::get();
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
                'store_id' => $reqDecode['store'],
                'image' => $file_name
            ]);
        }
    }
}
