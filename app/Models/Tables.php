<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tables extends Model
{
    use HasFactory;
    protected $fillable = [
        'store_id',
        'table_number',
        'seats_number'
    ];
    protected $hidden = [];
    public $timestamps = false;
}
