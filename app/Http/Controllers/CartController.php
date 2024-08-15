<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, $productId)
    {
        $product = Product::find($productId);

        // Validate the size
        $size = $request->input('size');
        if (!in_array($size, ['S', 'M', 'L', 'XL'])) {
            return redirect()->back()->withErrors('Invalid size selected.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            // Increase quantity if product already in cart
            $cart[$productId]['quantity'] += 1;
        } else {
            // Add product to cart with size
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => 1,
                'size' => $size, // Add size here
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }


    public function getCartContents()
    {
        $cart = session('cart', []);
        $html = '<h5 class="text-center">Cart Content</h5>';
    
        if (empty($cart)) {
            $html .= '<p class="text-center">Your cart is empty.</p>';
        } else {
            foreach ($cart as $id => $item) {
                $html .= '<div class="cart-item p-3 d-flex align-items-center">';
                $html .= '<img src="' . asset('storage/' . $item['image']) . '" alt="' . $item['name'] . '" class="img-fluid mr-2" style="width: 50px; height: 50px;">';
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
            $quantity = $request->input('quantity');
            $cart[$id]['quantity'] = $quantity;
            $cart[$id]['size'] = $request->input('size', $cart[$id]['size']); // Preserve old size if not updated
            
            session()->put('cart', $cart);
    
            // Return the updated cart item and total price
            return response()->json([
                'success' => true,
                'cart' => $cart[$id],
                'total' => array_sum(array_map(function($item) {
                    return $item['price'] * $item['quantity'];
                }, $cart))
            ]);
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
    
        // Check if the cart is empty
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }
    
        // Validate the request
        $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'payment' => 'required|in:cash_on_delivery',
            'notes' => 'nullable|string|max:1000',
        ]);
    
        // Calculate total price
        $total = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));
    
        // Create a new order with the total price and address details
        $order = Order::create([
            'user_id' => auth()->id(),
            'status' => 'pending',
            'total' => $total,
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'country' => $request->input('country'),
            'payment_method' => $request->input('payment'),
            'notes' => $request->input('notes'),
        ]);
    
        // Add order items
        foreach ($cart as $item) {
            $order->items()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }
    
        // Clear the cart
        $request->session()->forget('cart');
    
        // Pass cart data to the view
        return view('cart.checkout', compact('cart'))->with('success', 'Order placed successfully!');
    }
    
}
