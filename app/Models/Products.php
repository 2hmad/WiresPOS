<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'product_details',
        'price',
        'category',
        'code',
        'quantity',
        'store_id',
        'image'
    ];
    protected $hidden = [];
    public $timestamps = false;

    public function store()
    {
        return $this->hasOne(Stores::class, 'id', 'store_id');
    }
    public function category()
    {
        return $this->hasOne(Categories::class, 'id', 'category');
    }
}
