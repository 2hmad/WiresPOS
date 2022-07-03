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
        'store_id',
        'invoice_id',
        'items',
        'subtotal',
        'discount',
        'discount_type',
        'payment',
        'selected_table',
        'status',
        'created_at',
    ];
    protected $hidden = [];
    protected $dates = [
        'created_at',
    ];
    public $timestamps = false;

    public function store()
    {
        return $this->hasOne(Stores::class, 'id', 'store_id');
    }
}
