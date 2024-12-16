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
    
       
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }
    

        if ($request->has('category')) {
            $categoryName = $request->category;
            $query->whereHas('category', function ($q) use ($categoryName) {
                $q->where('name', $categoryName);
            });
        }
    

        if ($request->has('tag')) {
            $tagName = $request->tag;
            $query->whereHas('tags', function ($q) use ($tagName) {
                $q->where('name', $tagName);
            });
        }
    

        $products = $query->paginate(6);
    
    
        $categories = Category::all();
        $tags = Tag::all();
    
        return view('products.index', compact('products', 'categories', 'tags'));
    }
    

    public function create()
    {
 
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

        $categories = Category::all();

        
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

        $product->update($request->except('tags'));

    
        if ($request->has('tags')) {
            $product->tags()->sync($request->tags);
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);  // Find the product by its ID
    
        return view('products.show', compact('product'));  // Return the product view
    }
    
    public function destroy(Product $product)
    {
        
        $product->delete();
        
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
