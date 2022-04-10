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
            'price' => 'required',
            'picture' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        return Product::create($productsDetails);
    }

    public function viewProduct($id)
    {
        return Product::find($id);
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::find($id);
        
        $product->update($request->all());

        return $product;
    }

    public function deleteProduct($id)
    {
        return Product::destroy($id);
    }

    public function searchProduct($name)
    {
        return Product::where('name', 'like', '%'.$name.'%')->get();
    }
}
