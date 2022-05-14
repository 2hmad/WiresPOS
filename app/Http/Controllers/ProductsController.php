<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

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
            $file_path = $request->file('thumbnail')->storeAs('cats', $file_name, 'public');
            Products::updateOrCreate([
                'product_name' => $reqDecode['productName'],
                'product_details' => $reqDecode['productDetails'],
                'price' => $reqDecode['productPrice'],
                'category' => $reqDecode['category'],
                'code' => $reqDecode['code'],
                'image' => $file_name
            ]);
        }
    }
}
