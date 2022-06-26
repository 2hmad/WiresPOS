<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'invoice_id',
        'items',
        'subtotal',
        'payment',
        'created_at',
    ];
    protected $hidden = [];
    public $timestamps = false;
}
