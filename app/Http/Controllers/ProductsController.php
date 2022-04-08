<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function storeProducts(Request $request)
    {
        $productsDetails = $request->validate([

            'name' => 'required',
            'description' => 'nullable|string',
            'slug' => 'required',
            'price' => 'required'
        ]);

        return Product::create($productsDetails);
    }
}
