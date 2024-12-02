<?php

namespace App\Http\Controllers;

use App\Models\ToDoList;
use App\Models\User;
use App\Http\Controllers\UserAchievementController;
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
            ->orderBy('to_do_date', 'desc') // Order by created_at in descending order
            ->paginate(3); // Paginate with 3 items per page

        return view('todolist', compact('toDoLists'));
    }
    public function showHistory()
    {
        $user = Auth::user();
        $toDoLists = ToDoList::where('user_id', $user->id)
            ->where('status', 'completed')
            ->paginate(3); // Paginate with 3 items per page

        return view('todolisthistory', compact('toDoLists'));
    }
    public function updateProgress(Request $request, $id)
    {
        $user = Auth::user();
        $todo = ToDoList::findOrFail($id);

        // Update progress tugas
        $todo->progress += $request->input('progress');

        if ($todo->progress >= $todo->target) {
            $todo->status = 'completed';
            $todo->done_date = now();
            $todo->save();

            // Panggil UserAchievementController untuk memberikan achievement
            $achievementController = new UserAchievementController();
            $achievementController->giveAchievements($user);
        }

        $todo->save();

        return redirect()->back()->with('success', 'Progress updated successfully!');
    }
}
