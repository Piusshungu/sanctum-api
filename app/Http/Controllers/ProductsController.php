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

        if(request()->has('picture') && !is_null(request()->picture))
        {
            $pictureName = request()->file('picture')->getClientOriginalName();

            $path = request()->file('picture')->store('public/images');
    
            $savepicture = new Product();
    
            $savepicture->pictureName = $pictureName;
    
            $savepicture->path = $path;

            $productsDetails = array_merge($productsDetails, ['logo'=> $path]);
        }

        $SaveProduct = Product::create($productsDetails);

        $response = [

            'product' => $SaveProduct,

            'message' => 'Product has been successfully added',
        ];

        return response()->json($response, 200);
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
