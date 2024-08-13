<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Validation is now removed as we are no longer handling payment receipts
        $order = new Order();
        $order->user_id = auth()->id();
        $order->status = 'pending';
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }

    public function create()
    {
        return view('orders.create');
    }

    public function index()
    {
        if (auth()->user()->hasRole('Admin')) {
            // Admin sees all orders
            $orders = Order::all();
        } else {
            // Regular users see only their orders
            $orders = Order::where('user_id', auth()->id())->get();
        }
    
        return view('orders.index', compact('orders'));
    }

    public function update(Request $request, Order $order)
    {
        $order->status = $request->status;
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Order status updated!');
    }
}
