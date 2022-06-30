<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use App\Models\User;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function get(Request $request)
    {
        return Invoices::where('invoice_id', $request->id)->first();
    }
    public function getAll(Request $request)
    {
        $user = User::where('token', $request->header('token'))->first();
        return Invoices::where('user_id', $user->id)->get();
    }
    public function create(Request $request)
    {
        $user = User::where('token', $request->header('token'))->first();
        $check = Invoices::where('items', $request->items)->first();
        if ($check == null) {
            Invoices::create([
                'user_id' => $user->id,
                'store_id' => $user->store,
                'invoice_id' => time(),
                'items' => $request->items,
                'subtotal' => $request->subtotal,
                'discount' => $request->discount,
                'discount_type' => $request->discount_type,
                'payment' => $request->payment,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            return Invoices::where('items', $request->items)->with('store')->first();
        } else {
            return response()->json(['alert' => 'added before'], 404);
        }
    }
}
