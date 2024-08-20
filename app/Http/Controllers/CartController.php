<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\DiscountCode;
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
    
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }
    
        // Validate the size if needed
        $size = $request->input('size', 'M'); // Default size if not provided
    
        // Check if size is valid if size is required
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
                'product_id' => $productId, // Ensure product_id is included
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
            $cart[$id]['quantity'] = $request->input('quantity');
            $cart[$id]['size'] = $request->input('size'); // Update size
            session()->put('cart', $cart);

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

    public function applyDiscount(Request $request)
    {
        $request->validate([
            'discount_code' => 'required|string',
        ]);

        $discountCode = DiscountCode::where('code', $request->discount_code)
                                     ->where('is_active', true)
                                     ->first();

        if (!$discountCode) {
            return back()->withErrors(['discount_code' => 'Invalid or expired discount code.']);
        }

        // Store the discount amount in the session or use it in your calculation directly
        session(['discount_amount' => $discountCode->discount_amount]);

        return redirect()->route('checkout.index')->with('success', 'Discount code applied successfully!');
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }
    
        // Calculate total price
        $total = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));
        
        $discountAmount = 0;
    
        // Check if a discount code is provided
        if ($request->filled('discount_code')) {
            $discountCode = DiscountCode::where('code', $request->discount_code)
                                        ->where('is_active', true)
                                        ->first();
    
            if ($discountCode) {
                $discountAmount = $discountCode->discount_amount;
                // Ensure the discount doesn't make the total negative
                $total = max($total - $discountAmount, 0);
            } else {
                return redirect()->back()->with('error', 'Invalid or expired discount code.');
            }
        }
    
        // Create a new order with the total price
        $order = Order::create([
            'user_id' => auth()->id(),
            'status' => 'pending',
            'total' => $total,
            'discount_code' => $request->discount_code,
            'discount_amount' => $discountAmount,
            'name' => implode(', ', array_column($cart, 'name')), // Store product names
        ]);
    
        // Add product details to the orders table
        foreach ($cart as $item) {
            $order->update([
                'product_id' => $item['product_id'], // Ensure this matches your table structure
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }
    
        // Clear the cart
        $request->session()->forget('cart');
    
        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }
    
    
    
}
