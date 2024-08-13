<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalRevenue = Order::where('status', 'approved')->sum('total');

        return view('dashboard', compact('totalOrders', 'totalProducts', 'pendingOrders', 'totalRevenue'));
    }
}
