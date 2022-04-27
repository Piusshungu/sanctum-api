<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartList()
    {
        return \Cart::orderBy('created_at')->getContent();
    }

    public function addToCart(Request $request)
    {
        $product = \Cart::add([

            'name' => 'required',

            'price' => 'required',

            'quantity' => 'required',

            'attributes' => array(

                'image' => $request->image
            )

            ]);

            $response = [

                'product' => $product,

                'message' => 'Product successfully added to the cart',
            ];

            return response()->json($response, 200);
    }
}
