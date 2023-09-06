<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project();
        return view('admin.projects.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'title' => 'required|string|max:50',
                'description' => 'nullable|string',
                'cover' => 'nullable|image:jpeg,jpg,png'
            ]
        );

        //$data = $request->all();
        $project = new Project();

        if (array_key_exists('cover', $data)) {

            $img_url = Storage::putFile('project_covers', $data['cover']);
            $data['cover'] = $img_url;
        }

        $project->fill($data);
        $project->save();

        return to_route('admin.projects.index')
            ->with('alert-type', 'success')
            ->with('alert-message', "$project->title created with success");
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate(
            [
                'title' => 'required|string|max:50',
                'description' => 'nullable|string',
                'cover' => 'nullable|image:jpeg,jpg,png'
            ]
        );

        // $data = $request->all();

        if (array_key_exists('cover', $data)) {
            if ($project->cover) Storage::delete($project->cover);
            $img_url = Storage::putFile('project_covers', $data['cover']);
            $data['cover'] = $img_url;
        }

        $project->update($data);
        return to_route('admin.projects.show', $project)
            ->with('alert-type', 'success')
            ->with('alert-message', "$project->title updated with success");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return to_route('admin.projects.index')
            ->with('alert-type', 'success')
            ->with('alert-message', "$project->title deleted with success");
    }
}
