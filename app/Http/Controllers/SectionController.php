<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Category;
use App\Models\Product;
use App\Models\Carousel; 
use Illuminate\Http\Request;

class SectionController extends Controller
{

    public function show()
    {
        $welcomeSection = Section::where('section_name', 'welcome')->first();
        $products = Product::where('featured', true)->get(); 
        $categories = Category::all(); 
        $products = Product::latest()->take(6)->get();
        $carousels = Carousel::all();

        return view('welcome', compact('welcomeSection', 'products', 'categories', 'carousels'));
    }


    public function edit()
    {
        $welcomeSection = Section::where('section_name', 'welcome')->first();
        return view('admin.sections.edit', compact('welcomeSection'));
    }
    public function updateCarousel(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        // Find the carousel item by its ID
        $carousel = Carousel::findOrFail($id);

        // Handle the image upload if there's a new image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('carousel_images', 'public');
            $carousel->image = $imagePath;
        }

        // Update the other fields
        $carousel->title = $request->input('title');
        $carousel->description = $request->input('description');
        $carousel->save();

        // Redirect back with a success message
        return redirect()->route('admin.carousel.index')->with('success', 'Carousel updated successfully!');
    }
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Section::updateOrCreate(
            ['section_name' => 'welcome'],
            ['title' => $request->title, 'description' => $request->description]
        );

        return redirect()->route('admin.sections.edit')->with('success', 'Section updated successfully!');
    }

    public function manageCarousel()
    {
        $carousels = Carousel::all();
        return view('admin.carousel.index', compact('carousels'));
    }


    public function storeCarousel(Request $request)
    {
        $request->validate([
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $imagePath = $request->file('image_path')->store('carousels', 'public');

        Carousel::create([
            'image_path' => $imagePath,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.carousel.index')->with('success', 'Carousel image added successfully!');
    }

    public function editCarousel($id)
    {
        $carousel = Carousel::findOrFail($id);
        return view('admin.carousel.edit', compact('carousel'));
    }
    public function deleteCarousel($id)
    {
        $carousel = Carousel::findOrFail($id);
        $carousel->delete();

        return redirect()->route('admin.carousel.index')->with('success', 'Carousel image deleted successfully!');
    }
}
