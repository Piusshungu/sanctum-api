<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopsController extends Controller
{
    public function index()
    {
        return Shop::orderBy('shop_name')->filter(request(['search']))
            
        ->paginate(10)->withQueryString()->all();
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
    
            $saveLogo->logoName = $logoName;
    
            $saveLogo->path = $path;

            $attributes = array_merge($attributes, ['logo'=> $path]);
        }

        $shopDetails = Shop::create($attributes);

        $response = [

            'shop' => $shopDetails,

            'message' => 'Your Shop has been registered',
        ];

        return response()->json($response, 200);
    }

    public function editShop(Request $request, $id)
    {
        $attributes = $request->validate([

            'shop_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email|unique:shops,email,' .$id,
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
    
            $saveLogo->logoName = $logoName;
    
            $saveLogo->path = $path;

            $attributes = array_merge($attributes, ['logo'=> $path]);
        }

        $shop = Shop::find($id);

        $shop->update($attributes);

        $response = [

            'updated_shop_details' => $shop,

            'message' => 'Shop Details has been updated',
        ];

        return response()->json($response, 200);
    }

    public function deleteShop($id)
    {
        $shop = Shop::find($id);

        $shop->delete();

        return response()->json([

            'message' => 'Shop successfully deleted',
        ], 200);
    }
}
