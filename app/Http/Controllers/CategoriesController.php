<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function get()
    {
        return Categories::get();
    }
    public function getProducts($category_id)
    {
        return Products::where('category', $category_id)->with(['store', 'category'])->get();
    }
}
