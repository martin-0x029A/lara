<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $images = Gallery::all();
        return view('gallery', compact('images'));
    }

    public function store(Request $request)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'required|image|max:8192',
        ]);

        // Process the image file: read contents and encode to base64.
        $imageFile = $request->file('image');
        $imageData = file_get_contents($imageFile->getRealPath());
        $base64Image = base64_encode($imageData);

        // Create a new Gallery record
        Gallery::create([
            'name'        => $validatedData['name'],
            'description' => $validatedData['description'] ?? null,
            'image'       => $base64Image,
        ]);

        // Redirect back with a success message
        return redirect()->route('gallery')->with('success', 'Image uploaded successfully.');
    }
} 