<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\User;
use App\Task;

class TaskController extends Controller
{
    public function getForm()
    {
        $projects = Project::all();
        $users    = User::all();
        return view('task.create', compact('users', 'projects'));
    }
    public function submitForm(Request $request)
    {
        $request->validate([
            'name'       => 'required',
            'user_id'    => 'nullable|exists:users,id',
            'project_id' => 'nullable|exists:projects,id',
        ]);

        $maxPrioroty = Task::max('priority') ?: 0;

        $newTask             = new Task();
        $newTask->name       = $request->name;
        $newTask->project_id = $request->project_id;
        $newTask->priority   = ++$maxPrioroty;

        $newTask->save();

        return redirect()->route('task.table');
    }
    public function index()
    {
        $tasks    = Task::all();
        $projects = Project::all(); 
        return view('task.table', compact('tasks', 'projects'));
    }
    public function edit($id)
    {
        $task     = Task::findOrFail($id);
        $projects = Project::all();
        $users    = User::all();
        return view('task.edit', compact('task', 'projects', 'users'));
    }
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'name'       => 'required',
            'user_id'    => 'nullable|exists:users,id',
            'project_id' => 'nullable|exists:projects,id',
        ]);

        $task->name       = $request->name;
        $task->user_id    = $request->user_id;
        $task->project_id = $request->project_id;

        $task->save();

        return redirect()->route('task.table');
    }

}
