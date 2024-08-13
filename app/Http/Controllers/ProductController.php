<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
    
        // Search functionality by name
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
    
        // Filtering by price range
        if ($request->has('min_price') && $request->has('max_price')) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);
        }
    
        // Paginate the results
        $products = $query->paginate(10);
    
        // Pass categories for filtering if needed
        $categories = Category::all();
    
        return view('products.index', compact('products', 'categories'));
    }
    
    public function create()
    {
        // Pass categories and tags to the create view
        $categories = Category::all();
        $tags = Tag::all();
        
        return view('products.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $data = $request->except('tags', 'image');
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }
    
        $product = Product::create($data);
    
        if ($request->has('tags')) {
            $product->tags()->attach($request->tags);
        }
    
        return redirect()->route('products.index');
    }
    
    

    public function edit(Product $product)
    {
        // Fetch categories and tags for the edit view
        $categories = Category::all();
        // $tags = Tag::all();
        
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        // Update the product without tags
        $product->update($request->except('tags'));

        // Sync tags with the product
        if ($request->has('tags')) {
            $product->tags()->sync($request->tags);
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        // Detach tags before deleting the product
        // $product->tags()->detach();
        $product->delete();
        
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
