<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product; // Add this if not already included

class SectionController extends Controller
{
    public function show()
    {
        $welcomeSection = Section::where('section_name', 'welcome')->first();
        $products = Product::where('featured', true)->get(); // Retrieve featured products
        $categories = Category::all(); // Retrieve all categories
        $products = Product::latest()->take(6)->get();

        return view('welcome', compact('welcomeSection', 'products', 'categories'));
    }

    public function edit()
    {
        $welcomeSection = Section::where('section_name', 'welcome')->first();
        return view('admin.sections.edit', compact('welcomeSection'));
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
}
