<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        return Order::orderBy('created_at')->filter(request(['search']))
            
        ->paginate(10)->withQueryString()->all();
    }
}
