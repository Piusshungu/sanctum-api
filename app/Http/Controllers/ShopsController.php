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
}
