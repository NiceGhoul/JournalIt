<?php

namespace App\Http\Controllers;

use App\Models\ToDoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ToDoListController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'to_do_date' => 'required|date',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'target' => 'required|integer|min:1',
        ]);

        ToDoList::create([
            'name' => $request->input('name'),
            'to_do_date' => $request->input('to_do_date'),
            'logo' => $request->file('logo') ? $request->file('logo')->store('logos', 'public') : null,
            'target' => $request->input('target'),
            'progress' => 0,
            'status' => 'Pending',
            'user_id' => Auth::id(),
            'date_added' => now(),
        ]);

        return redirect()->back()->with('success', 'To-Do List created successfully!');
    }

    public function show()
    {
        $user = Auth::user();
        $toDoLists = ToDoList::where('user_id', $user->id)
            ->where('status', '!=', 'completed')
            ->get();

        return view('todolist', compact('toDoLists'));
    }
    public function showHistory()
    {
        $user = Auth::user();
        $toDoLists = ToDoList::where('user_id', $user->id)
            ->where('status', 'completed')
            ->get();

        return view('todolisthistory', compact('toDoLists'));
    }
    public function updateProgress(Request $request, $id)
    {
        $todo = ToDoList::findOrFail($id);

        $todo->progress += $request->input('progress');

        if ($todo->progress >= $todo->target) {
            $todo->status = 'completed';
            $todo->done_date = now();
        }

        $todo->save();

        return redirect()->back()->with('success', 'Progress updated successfully!');
    }
}
