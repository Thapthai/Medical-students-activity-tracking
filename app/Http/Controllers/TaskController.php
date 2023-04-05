<?php

namespace App\Http\Controllers;

use App\Models\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /// create Index
    public function index()
    {
        $data['task'] = Task::orderBy('id', 'desc')->paginate(5);
        return view('task.index', $data);
    }

    // create resource 
    public function create()
    {
        return view('task.create');
    }

    //store 
    public function store(Request $request)
    {
        $request->validate([
            'activity_id' => 'required',
            'file_path' => 'required',
            'point' => 'required',
            'task_owner' => 'required',
            'decision' => 'required',

        ]);
        $task = new Task;
        $task->activity_id = $request->activity_id;
        $task->file_path = $request->file_path;
        $task->point = $request->point;
        $task->task_owner = $request->task_owner;
        $task->decision = $request->decision;
        $task->save();
        return redirect()->route('home');
    }
    public function getpoint(Request $request, $id) // ac id
    {
        $task = Task::find($id);
        $task->point = $request->input('point');
        $task->update();
        return redirect()->route('home');
    }
}
