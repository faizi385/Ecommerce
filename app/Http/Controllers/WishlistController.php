<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    // Display the user's wishlist
    public function index()
    {
        $wishlistItems = auth()->user()->wishlist()->with('product')->get();

        return view('wishlist.index', compact('wishlistItems'));
    }

    // Add a product to the wishlist
    public function add(Request $request, $productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        // Check if the product is already in the user's wishlist
        $wishlist = Wishlist::firstOrCreate([
            'user_id' => auth()->id(),
            'product_id' => $productId,
        ]);

        return redirect()->back()->with('success', 'Product added to wishlist!');
    }

    // Remove a product from the wishlist
    public function remove($productId)
    {
        $wishlist = Wishlist::where('user_id', auth()->id())
                            ->where('product_id', $productId)
                            ->first();

        if ($wishlist) {
            $wishlist->delete();
        }

        return redirect()->back()->with('success', 'Product removed from wishlist!');
    }
}
