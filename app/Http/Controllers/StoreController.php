<?php

namespace App\Http\Controllers;

use App\Models\Stores;
use App\Models\User;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function get(Request $request)
    {
        $user = User::where('token', $request->header('token'))->first();
        if ($user->role == 'admin') {
            return Stores::where('id', $user->store)->first();
        } else {
            return response()->json(['alert' => 'permission denied'], 404);
        }
    }
    public function update(Request $request)
    {
        if ($request->pic !== null) {
            $validated = $request->validate([
                'pic' => 'mimes:jpg,png,jpeg,svg'
            ]);
            if ($validated) {
                $reqDecode = json_decode($request->data, true);
                $file_name = 'store-' . $reqDecode['id'] . '.' . $request->pic->getClientOriginalExtension();
                $file_path = $request->file('pic')->storeAs('stores', $file_name, 'public');
                $check_store = Stores::where('id', $reqDecode['id'])->first();
                if ($check_store !== null) {
                    Stores::where('id', $reqDecode['id'])->update([
                        'store_name' => $reqDecode['name'],
                        'email' => $reqDecode['email'],
                        'address' => $reqDecode['address'],
                        'phone' => $reqDecode['phone'],
                        'website' => $reqDecode['website'],
                        'legally' => $reqDecode['legally'],
                        'logo' => $file_name
                    ]);
                } else {
                    Stores::create([
                        'store_name' => $reqDecode['name'],
                        'email' => $reqDecode['email'],
                        'address' => $reqDecode['address'],
                        'phone' => $reqDecode['phone'],
                        'website' => $reqDecode['website'],
                        'legally' => $reqDecode['legally'],
                        'logo' => $file_name,
                        'plan' => 'free'
                    ]);
                }
            }
        } else {
            $check_store = Stores::where('id', $request->id)->first();
            if ($check_store !== null) {
                Stores::where('id', $request->id)->update([
                    'store_name' => $request->name,
                    'email' => $request->email,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'website' => $request->website,
                    'legally' => $request->legally,
                ]);
            } else {
                Stores::create([
                    'store_name' => $request->name,
                    'email' => $request->email,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'website' => $request->website,
                    'legally' => $request->legally,
                    'plan' => 'free'
                ]);
            }
        }
    }
}
