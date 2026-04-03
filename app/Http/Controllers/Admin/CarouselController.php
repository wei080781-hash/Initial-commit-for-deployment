<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::orderBy('order')->get();
        return view('admin.carousels.index', compact('carousels'));
    }

    public function create()
    {
        return view('admin.carousels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'order' => 'integer'
        ]);

        $imagePath = $request->file('image')->store('carousels', 'public');

        Carousel::create([
            'image_path' => $imagePath,
            'title' => $request->title,
            'description' => $request->description,
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('admin.carousels.index')->with('success', '輪播圖新增成功');
    }

    public function edit(Carousel $carousel)
    {
        return view('admin.carousels.edit', compact('carousel'));
    }

    public function update(Request $request, Carousel $carousel)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'order' => 'integer'
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($carousel->image_path);
            $imagePath = $request->file('image')->store('carousels', 'public');
            $carousel->image_path = $imagePath;
        }

        $carousel->title = $request->title;
        $carousel->description = $request->description;
        $carousel->order = $request->order ?? 0;
        $carousel->save();

        return redirect()->route('admin.carousels.index')->with('success', '輪播圖更新成功');
    }

    public function destroy(Carousel $carousel)
    {
        Storage::disk('public')->delete($carousel->image_path);
        $carousel->delete();
        return redirect()->route('admin.carousels.index')->with('success', '輪播圖刪除成功');
    }
}
