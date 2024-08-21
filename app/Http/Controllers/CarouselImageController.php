<?php
namespace App\Http\Controllers;

use App\Models\CarouselImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselImageController extends Controller
{
    public function index()
    {
        $carouselImages = CarouselImage::all();
        return view('admin.carousel.index', compact('carouselImages'));
    }

    public function create()
    {
        return view('admin.carousel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $imagePath = $request->file('image')->store('carousel_images', 'public');

        CarouselImage::create([
            'image_path' => $imagePath,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('admin.carousel.index')->with('success', 'Image added to carousel.');
    }

    public function edit(CarouselImage $carouselImage)
    {
        return view('admin.carousel.edit', compact('carouselImage'));
    }

    public function update(Request $request, CarouselImage $carouselImage)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($carouselImage->image_path);
            $imagePath = $request->file('image')->store('carousel_images', 'public');
            $carouselImage->image_path = $imagePath;
        }

        $carouselImage->title = $request->input('title');
        $carouselImage->description = $request->input('description');
        $carouselImage->save();

        return redirect()->route('admin.carousel.index')->with('success', 'Image updated.');
    }

    public function destroy(CarouselImage $carouselImage)
    {
        Storage::disk('public')->delete($carouselImage->image_path);
        $carouselImage->delete();

        return redirect()->route('admin.carousel.index')->with('success', 'Image removed.');
    }
}
