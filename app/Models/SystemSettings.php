<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSettings extends Model
{
    use HasFactory;
    protected $fillable = [
        'store_id',
        'tax_rate',
        'currency'
    ];
    protected $hidden = [];
    public $timestamps = false;
}
