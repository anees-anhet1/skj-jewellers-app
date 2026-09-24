<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CollectionController extends Controller
{
    public function adminIndex()
    {
        $collections = Collection::orderBy('created_at', 'desc')->get();
        return view('admin.collections', compact('collections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image',
        ]);

        $data = $request->only('name', 'description');
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('collections', 'public');
        }

        Collection::create($data);

        return back()->with('success', 'Collection created successfully.');
    }

    public function destroy($id)
    {
        $collection = Collection::findOrFail($id);
        if ($collection->image) {
            Storage::disk('public')->delete($collection->image);
        }
        $collection->delete();

        return back()->with('success', 'Collection deleted successfully.');
    }
}
