<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('order')->get();
        return view('pages.tasks', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $task = Task::create(['name' => $request->name]);

        return response()->json($task);
    }

    public function update(Request $request, Task $task)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $task->name = $request->name;
        $task->save();

        return response()->json($task);
    }

    public function toggle(Task $task)
    {
        $task->is_done = !$task->is_done;
        $task->save();

        return response()->json(['id' => $task->id, 'is_done' => $task->is_done]);
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array'
        ]);

        foreach ($request->order as $index => $id) {
            Task::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['status' => 'ok']);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json(['id' => $task->id]);
    }
}
