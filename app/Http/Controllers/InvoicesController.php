<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use App\Models\User;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function create(Request $request)
    {
        $user = User::where('token', $request->header('token'))->first();
        Invoices::create([
            'user_id' => $user->id,
            'invoice_id' => rand(10, 50),
            'items' => $request->items,
            'subtotal' => $request->subtotal,
            'payment' => $request->payment,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
