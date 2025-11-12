<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guides = Guide::orderBy('id', 'DESC')->get();
        return view('admin.guide.index', compact('guides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.guide.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validasi = $request->validate([
                'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
                'name' => 'required|string',
                'expertise' => 'required|string',
                'social_media' => 'required|string'
            ]);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('uploads/home', $filename, 'public');
                $validasi['image'] = $path;
            }


            $social_media = [];
            if ($request->social_media) {
                $social_media = array_map('trim', explode(',', $request->social_media));
            }
            $validasi['social_media'] = $social_media;

            Guide::create($validasi);
            return redirect()->route('guideadmin.index');
        } catch (\Exception $th) {
            return back()->withErrors(['error' => 'There is an error' . $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $guide = Guide::find($id);
            $validasi = $request->validate([
                'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'name' => 'required|string',
                'expertise' => 'required|string',
                'social_media' => 'required|json'
            ]);
            if ($request->hasFile('image')) {
                // Delete syntax when there is image available
                if ($guide->image && Storage::disk('public')->exists($guide->image)) {
                    Storage::disk('public')->delete($guide->image);
                }
                // Upload new image
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('uploads/guide', $filename, 'public');
                $validasi['image'] = $path;
            } else {
                // If it doesnt need to be changed, then the old image will still be saved
                $validasi['image'] = $guide->image;
            }
            $guide->update($validasi);
            return redirect()->route('homeadmin.index');
        } catch (\Exception $th) {
            return back()->withErrors(['error' => 'There is something wrong' . $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $guide = Guide::find($id);
        if ($guide->image && Storage::disk('public')->exists($guide->image)) {
            Storage::disk('public')->delete($guide->image);
        }
        $guide->delete();

        return redirect()->route('guideadmin.index');
    }
}
