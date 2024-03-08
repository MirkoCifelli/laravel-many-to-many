<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;

// Models
use App\Models\Technology;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies= Technology::all();
        return view('admin.technologies.index',compact('technologies'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologyRequest $request)
    {
        $technologiesData = $request->validate([
            'title'=> 'required|string|'
        ]);

        $slug = str()->slug($technologiesData['title']);

        $technology = Technology::create([
            'title' => $technologiesData['title'],
            'slug' => $slug,
        ]);

        return redirect()->route('admin.technologies.show', ['technologie' => $technology->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $technology = Technology::where('slug', $slug)->firstOrFail();
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        $technologiesData = $request->validate([
            'title'=> 'required|string|'
        ]);

        $slug = str()->slug($technologiesData['title']);

        $technology = Technology::create([
            'title' => $technologiesData['title'],
            'slug' => $slug,
        ]);

        return redirect()->route('admin.technologies.show', ['technology' => $technology->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology-> delete();
        return redirect()->route('admin.technologies.index');
    }
}
