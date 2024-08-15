<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        
        $categories = Category::all();
        $products = Product::latest()->take(8)->get(); // Get the latest 8 products or adjust as needed

        return view('welcome', compact('categories', 'products'));
    }
}
