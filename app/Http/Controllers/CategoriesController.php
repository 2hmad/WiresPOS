<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function get()
    {
        return Categories::orderBy('id', 'DESC')->get();
    }
    public function getProducts($category_id)
    {
        return Products::where('category', $category_id)->orderBy('id', 'DESC')->with(['store', 'category'])->get();
    }
}
