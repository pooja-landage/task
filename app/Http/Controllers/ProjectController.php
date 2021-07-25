<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;


class ProjectController extends Controller
{
    public function create()
    {
        return view('project.form');
    }
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $newProject = new Project();

        $newProject->name = $request->name;
        $newProject->save();
        return redirect()->route('project.index')->with('message', 'Data Successfully Added');
    }
      public function getTable()
    {
        $projects = Project::all();
        return view('project.index', compact('projects'));
    }
    public function editForm($id)
    {
       $project = Project::findOrFail($id);
        return view('project.edit', compact('project'));
    }
    public function updateForm(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'name' => 'required',
        ]);

        $project->name = $request->name;
        $project->save();

        return redirect()->route('project.index');
    }
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->route('project.index');
    }
    
}
