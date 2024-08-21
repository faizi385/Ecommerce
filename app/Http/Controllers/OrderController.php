<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Mail\OrderConfirmed;
use Illuminate\Http\Request;
use App\Mail\OrderStatusChanged;
use App\Notifications\OrderPlaced;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
   public function store(Request $request)
{
    // Validate the request
    $validated = $request->validate([
        'total' => 'required|numeric',
        'name' => 'nullable|string',
        'price' => 'nullable|numeric',
    ]);

    // Create the order
    $order = Order::create([
        'user_id' => Auth::id(),
        'total' => $validated['total'],
        'status' => 'pending',
        'name' => $validated['name'],
        'price' => $validated['price'],
    ]);

    // Check if order was created
    if (!$order) {
        return redirect()->route('orders.create')->withErrors('Failed to create order.');
    }

    // Send email to the authenticated user
    $user = Auth::user();
    Mail::to($user->email)->send(new OrderConfirmed($order));

    return redirect()->route('orders.index')->with('success', 'Order placed successfully.');
}

    

    public function create()
    {
        return view('orders.create');
    }

    public function index(Request $request)
    {
        $status = $request->input('status');

        if (auth()->user()->hasRole('Admin')) {
            $orders = Order::with('items.product')
                           ->when($status, function ($query, $status) {
                               return $query->where('status', $status);
                           })
                           ->get(); // Retrieve all orders without pagination
        } else {
            $orders = Order::where('user_id', auth()->id())
                           ->with('items.product')
                           ->when($status, function ($query, $status) {
                               return $query->where('status', $status);
                           })
                           ->get(); // Retrieve all orders without pagination
        }
    
        return view('orders.index', compact('orders', 'status'));
    }

    public function update(Request $request, Order $order)
    {
        // Validate the request
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,canceled',
        ]);
    
        // Update order status
        $order->status = $request->status;
        $order->save();
    
        // Send email if the status is processing or delivered
        if ($order->status === 'processing' || $order->status === 'delivered') {
            Mail::to($order->user->email)->send(new OrderStatusChanged($order));
        }
    
        return redirect()->route('orders.index')->with('success', 'Order status updated successfully.');
    }
    
    

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.show', compact('order'));
    }
    
    
}
