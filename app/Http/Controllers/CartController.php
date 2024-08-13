<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{  public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::find($id);

        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }
    public function getCartContents()
    {
        $cart = session('cart', []);
        $html = '<h5 class="text-center">Cart Contents</h5>';
    
        if (empty($cart)) {
            $html .= '<p class="text-center">Your cart is empty.</p>';
        } else {
            foreach ($cart as $id => $item) {
                $html .= '<div class="cart-item p-3 d-flex align-items-center">';
                $html .= '<img src="' . asset('storage/' . (isset($item['image']) ? $item['image'] : 'default.png')) . '" alt="' . $item['name'] . '" class="img-fluid mr-2" style="width: 50px; height: 50px;">';
                $html .= '<div class="cart-item-details">';
                $html .= '<p class="mb-1"><strong>' . $item['name'] . '</strong></p>';
                $html .= '<p class="mb-1">Quantity: ' . $item['quantity'] . '</p>';
                $html .= '<p class="mb-1">Price: $' . number_format($item['price'], 2) . '</p>';
                $html .= '</div>';
                $html .= '</div>';
            }
    
            $html .= '<div class="text-center mt-2">';
    
            $html .= '</div>';
        }
    
        return response()->json(['html' => $html]);
    }
    
    
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
    
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->input('quantity');
            session()->put('cart', $cart);
    
            // Optionally return HTML or other data
            return response()->json(['success' => true, 'message' => 'Quantity updated!']);
        }
    
        return response()->json(['success' => false, 'message' => 'Item not found in cart.']);
    }
    
    
    

    public function remove($id)
    {
        $cart = session()->get('cart', []);
    
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
    
        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        
        // Calculate total price
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity']; // Adjust based on your cart structure
        }
    
        // Create a new order with the total price
        $order = Order::create([
            'user_id' => auth()->id(),
            'status' => 'pending',
            'total' => $total, // Include the total field
        ]);
    
        // Add order items (if you have an order_items table or similar)
        // foreach ($cart as $item) {
        //     $order->items()->create([
        //         'product_id' => $item['product_id'],
        //         'quantity' => $item['quantity'],
        //         'price' => $item['price'], // Adjust based on your structure
        //     ]);
        // }
    
        // Clear the cart
        $request->session()->forget('cart');
    
        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }
    
    
}
