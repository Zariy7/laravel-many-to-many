<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Type;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller as Controller;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects_db = Project::all();

        return view('admin.projects.index', compact('projects_db'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types_db = Type::all();

        return view('admin.projects.create', compact('types_db'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->all();

        if($request->hasFile('image')){
            $image_path = Storage::disk('public')->put('project_images', $data['image']);
            $data['image'] = $image_path;
        }

        $newProject = new Project();
        $newProject->fill($data);
        $newProject->slug = Str::slug($newProject->title, '-');

        $newProject->save();

        return redirect()->route('admin.projects.show', $newProject->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types_db = Type::all();

        return view('admin.projects.edit', compact('project', 'types_db'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->all();

        if($request->hasFile('image')){
            if($project->image != null){
                Storage::disk('public')->delete($project->image);
            }

            $image_path = Storage::disk('public')->put('project_images', $data['image']);
            $data['image'] = $image_path;
        }

        $project->slug = Str::slug($project->title, '-');
        $data['slug'] = $project->slug;
        $project->update($data);

        return redirect()->route('admin.projects.show', $project->id);    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if($project->image != null){
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
