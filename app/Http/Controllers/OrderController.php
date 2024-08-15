<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Mail\OrderConfirmed;
use Illuminate\Support\Facades\Mail;

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
            // Admin sees all orders with related order items and products
            $orders = Order::with('items.product')->get();
        } else {
            // Regular users see only their orders with related order items and products
            $orders = Order::where('user_id', auth()->id())
                           ->with('items.product')
                           ->get();
        }
    
        return view('orders.index', compact('orders'));
    }

    public function update(Request $request, Order $order)
    {
        // Validate the request
        $request->validate([
            'status' => 'required|in:pending,approved,canceled',
        ]);
    
        // Update order status
        $order->status = $request->status;
        $order->save();
    
        // Send email if the status is approved
        if ($order->status === 'approved') {
            // For testing purposes, sending email to a specific address
            Mail::to($order->user->email)->send(new OrderConfirmed($order));
        }
    
        return redirect()->route('orders.index')->with('success', 'Order status updated successfully.');
    }
}
