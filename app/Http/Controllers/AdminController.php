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
        $totalRevenue = Order::where('status', 'delivered')->sum('total');
 
        $salesData = [];
        $currentMonth = now()->startOfMonth();
        for ($i = 0; $i < 12; $i++) {
            $monthStart = $currentMonth->copy()->startOfMonth();
            $monthEnd = $currentMonth->copy()->endOfMonth();
    
            $monthlyRevenue = Order::whereBetween('created_at', [$monthStart, $monthEnd])
                                   ->where('status', 'delivered')
                                   ->sum('total');
    
            $salesData['labels'][] = $currentMonth->format('F');
            $salesData['values'][] = $monthlyRevenue;
    
            $currentMonth->subMonth();
        }
        $salesData['labels'] = array_reverse($salesData['labels']);
        $salesData['values'] = array_reverse($salesData['values']);
    
        return view('dashboard', compact('totalOrders', 'totalProducts', 'pendingOrders', 'totalRevenue', 'salesData'));
    }
    
}
