<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stores extends Model
{
    use HasFactory;
    protected $fillable = [
        'store_name',
        'email',
        'address',
        'phone',
        'website',
        'legally',
        'logo',
        'plan',
    ];
    protected $hidden = [];
    public $timestamps = false;
}
