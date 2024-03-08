<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Models
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;

// Helpers
use Illuminate\Support\Str;

//Form Request
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Validation\ValidationData;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view("admin.projects.index", compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $technologies = Technology::all();
        $types = Type::all();
        return view("admin.projects.create",compact('types','technologies'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        
        $validationData=$request->validated();

        $slug = Str::slug($validationData['title']);
      
       
        // $project = Project::create($validationData);

        $project = Project::create([
            'title' => $validationData['title'],
            'slug' => $slug,
            'content'=> $validationData['content'],
            'type_id'=>$validationData['type_id'],
        ]);

        if (isset($validationData['technologies'])) {
            foreach ($validationData['technologies'] as $singleTagId) {
               
                $project->technologies()->attach($singleTagId);
            }
        }

        return redirect()->route('admin.projects.show', ['project' => $project->slug]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $technologies = Technology::all();
        $types = Type::all();
        $project = Project::where('slug', $slug)->firstOrFail();
        return view('admin.projects.edit', compact('project','types','technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, string $slug)
    {
        $validationData=$request->validated();

        $project = Project::where('slug', $slug)->firstOrFail();
        $slug = Str::slug($validationData['title']);
        $validationData['slug'] = $slug;
        
        
        $project->updateOrFail($validationData);

        if (isset($validationData['technologies'])) {
            $project->technologies()->sync($validationData['technologies']);
        }
        else {
            $project->technologies()->detach();
        }

        
        // $project->update($validationData);
        return redirect()->route('admin.projects.show', ['project' => $project->slug]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
