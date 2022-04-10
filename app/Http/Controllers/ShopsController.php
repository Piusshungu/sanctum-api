<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopsController extends Controller
{
    public function index()
    {
        return Shop::all()->orderBy('shop_name')->filter(request(['search']))
            
        ->paginate(10)->withQueryString();
    }

    public function registerShop(Request $request)
    {
        $attributes = $request->validate([

            'shop_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email|unique:shops,email,',
            'logo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'location' => 'required',
            'category' => 'required',
            'business_licence' => 'required',
            'password' => 'required|confirmed'
        ]);

        if(request()->has('logo') && !is_null(request()->logo))
        {
            $logoName = request()->file('logo')->getClientOriginalName();

            $path = request()->file('logo')->store('public/images');
    
            $saveLogo = new Shop();
    
            $saveLogo->avatarName = $logoName;
    
            $saveLogo->path = $path;

            $attributes = array_merge($attributes, ['logp'=> $path]);
        }

        return Shop::create($attributes);
    }
}
