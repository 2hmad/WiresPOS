<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredients extends Model
{
    use HasFactory;
    protected $fillable = [
        'store_id',
        'product_id',
        'ingredients'
    ];
    protected $hidden = [];
    public $timestamps = false;

    public function product()
    {
        return $this->hasOne(Products::class, 'id', 'product_id');
    }
}
