<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        // Retrieve all tasks from the database
        $tasks = Task::paginate(5); // Assuming you want pagination with 5 tasks per page
    
        // Return the tasks to the home view
        return view('home', ['tasks' => $tasks]);
    }
    
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
        ]);
    
        try {
            // Create a new task using the validated data
            $task = new Task();
            $task->title = $request->title;
            $task->description = $request->description;
            $task->due_date = $request->due_date;
            $task->save();
    
            // Return a success message
            return response()->json(['success' => 'Task created successfully'], 200);
        } catch (\Exception $e) {
            // If an error occurs during task creation, return an error response
            return response()->json(['error' => 'Failed to create task. Please try again.'], 500);
        }
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('edit_task', compact('task'));
    }

    public function update(Request $request, $id)
    {
        // Validation
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
        ]);

        $task = Task::findOrFail($id);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }
}
