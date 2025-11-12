<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = About::orderBy('id', 'DESC')->get();
        return view('admin.about.index', compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.about.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validasi = $request->validate([
                'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
                'title' => 'required|string',
                'description' => 'required|string',
                'features' => 'required|string'
            ]);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('uploads/about', $filename, 'public');
                $validasi['image'] = $path;
            }

            $features = [];
            if ($request->features) {
                $features = array_map('trim', explode(',', $request->features));
            }
            $validasi['features'] = $features;

            //INSERT INTO abouts () VALUEs ()
            About::create($validasi);
            return redirect()->route('aboutadmin.index');
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
        $about = About::find($id);
        return view('admin.about.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $about = About::find($id);
            try {
                $validasi = $request->validate([
                    'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                    'title' => 'required|string',
                    'description' => 'required|string',
                    'features' => 'required|string'
                ]);
                if ($request->hasFile('image')) {
                    // Delete syntax when there is image available
                    if ($about->image && Storage::disk('public')->exists($about->image)) {
                        Storage::disk('public')->delete($about->image);
                    }
                    // Upload new image
                    $file = $request->file('image');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('uploads/about', $filename, 'public');
                    $validasi['image'] = $path;
                } else {
                    // If it doesnt need to be changed, then the old image will still be saved
                    $validasi['image'] = $about->image;
                }

                $features = [];
                if ($request->features) {
                    $features = array_map('trim', explode(',', $request->features));
                }
                $validasi['features'] = $features;
                $about->update($validasi);
                return redirect()->route('aboutadmin.index');
            } catch (\Throwable $th) {
                return back()->withErrors(['error' => 'There is an error' . $th->getMessage()]);
            }
        } catch (\Throwable $th) {
            return back()->withErrors(['error' => 'Unexpected error: ' . $th->getMessage()]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        $about = About::find($id);
        if ($about->image && Storage::disk('public')->exists($about->image)) {
            Storage::disk('public')->delete($about->image);
        }
        $about->delete();

        return redirect()->route('aboutadmin.index');
    }
}
