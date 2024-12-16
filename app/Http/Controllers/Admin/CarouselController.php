<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::all();
        return view('admin.carousel.index', compact('carousels'));
    }

    public function create()
    {
        return view('admin.carousel.create');
    }

    public function store(Request $request)
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

        return redirect()->route('admin.carousel.index')->with('success', 'Carousel image added successfully.');
    }


    // Other methods like edit, update, and destroy would be similar.
}
