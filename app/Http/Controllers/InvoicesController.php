<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use App\Models\Stores;
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
            $store = Stores::where('id', $user->store)->first();
            if ($store->plan == 'free') {
                $countInvoices = Invoices::where('store_id', $user->store)->whereMonth('created_at', date('m'))->count();
                if ($countInvoices < 10) {
                    Invoices::create([
                        'user_id' => $user->id,
                        'store_id' => $user->store,
                        'invoice_id' => time(),
                        'items' => $request->items,
                        'subtotal' => $request->subtotal,
                        'discount' => $request->discount,
                        'discount_type' => $request->discount_type,
                        'payment' => $request->payment,
                        'status' => 'paid',
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                    return Invoices::where('items', $request->items)->with('store')->first();
                } else {
                    return response()->json(['alert' => 'rechead maximum invoices'], 404);
                }
            } else {
                Invoices::create([
                    'user_id' => $user->id,
                    'store_id' => $user->store,
                    'invoice_id' => time(),
                    'items' => $request->items,
                    'subtotal' => $request->subtotal,
                    'discount' => $request->discount,
                    'discount_type' => $request->discount_type,
                    'payment' => $request->payment,
                    'status' => 'paid',
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                return Invoices::where('items', $request->items)->with('store')->first();
            }
        } else {
            return response()->json(['alert' => 'added before'], 404);
        }
    }
    public function revenue(Request $request, $range)
    {
        if ($range == 'month') {
            $user = User::where('token', $request->header('token'))->first();
            $current_month = \Carbon\Carbon::parse(date('Y-m-d'))->format('m');
            return Invoices::where('user_id', $user->id)->whereMonth('created_at', $current_month)->sum('subtotal');
        } else if ($range == 'day') {
            $user = User::where('token', $request->header('token'))->first();
            $current_day = \Carbon\Carbon::parse(date('Y-m-d'))->format('d');
            return Invoices::where('user_id', $user->id)->whereDay('created_at', $current_day)->sum('subtotal');
        }
    }
    public function monthly_invoices(Request $request)
    {
        $user = User::where('token', $request->header('token'))->first();
        $current_month = \Carbon\Carbon::parse(date('Y-m-d'))->format('m');
        return Invoices::where('user_id', $user->id)->whereMonth('created_at', $current_month)->count();
    }
    public function revenue_statistics(Request $request)
    {
        $user = User::where('token', $request->header('token'))->first();
        $current_year = \Carbon\Carbon::parse(date('Y-m-d'))->format('Y');
        return Invoices::where('user_id', $user->id)->whereYear('created_at', $current_year)->get()->groupBy([function ($val) {
            return $val->created_at->format('M');
        }]);
    }
    public function refund(Request $request)
    {
        Invoices::where('id', $request->id)->update([
            'status' => 'refund'
        ]);
    }
}
