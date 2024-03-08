<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Models
use App\Models\Type;


class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types= Type::all();
        return view('admin.types.index',compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $typeData = $request->validate([
            'title'=> 'required|string|'
        ]);

        $slug = str()->slug($typeData['title']);

        $type = Type::create([
            'title' => $typeData['title'],
            'slug' => $slug,
        ]);

        return redirect()->route('admin.types.show', ['type' => $type->slug]);
    }

    /**
     * Display the specified resource.
     */
    // public function show(Type $type)
    // {
    //     return view('admin.types.show', compact('type'));
    // }
    public function show(string $slug)
    {
        $type = Type::where('slug', $slug)->firstOrFail();
        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $type = Type::where('slug', $slug)->firstOrFail();
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        $typeData = $request->validate([
            'title' => 'required|string|max:32'
        ]);

        $slug = str()->slug($typeData['title']);

        $type->update([
            'title' => $typeData['title'],
            'slug' => $slug,
        ]);

        return redirect()->route('admin.types.show', ['type' => $type->slug]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $type = Type::where('slug', $slug)->firstOrFail();
        $type-> delete();
        return redirect()->route('admin.types.index');
    }
}
