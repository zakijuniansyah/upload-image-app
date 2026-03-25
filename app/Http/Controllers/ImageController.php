<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = Image::latest()->get(); //ambil semua data

        return view('dashboard', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $file = $data['image'];

        $filename = time() . '.' . $file->getClientOriginalExtension();

        $data['image'] = $file->storeAs('image', $filename, 'public');

        Image::create($data);

        return back()->with('success', 'Gambar Berhasil Diupload');
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         // 1. Ambil data dari DB
        $image = Image::findOrFail($id);

        // 2. Hapus file dari storage
        Storage::disk('public')->delete($image->image);

        // 3. Hapus dari database
        $image->delete();

        // 4. Redirect
        return back()->with('success', 'Gambar berhasil dihapus!');
    }
}
