<?php

namespace App\Http\Controllers;

use App\Models\ToDoList;
use App\Models\Achievement;
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
            ->where('status', '!=', 'Finished')
            ->orderBy('to_do_date', 'asc')
            ->paginate(3);

        // Pass the paginated results to the view
        return view('todolist', compact('toDoLists'));
    }
    public function showHistory()
    {
        $user = Auth::user();
        $toDoLists = ToDoList::where('user_id', $user->id)
            ->where('status', 'Finished')
            ->paginate(3); // Paginate with 3 items per page

        return view('todolisthistory', compact('toDoLists'));
    }
    public function updateProgress(Request $request, $id)
    {
        $user = Auth::user();
        $todo = ToDoList::findOrFail($id);
        // Update progress  
        $todo->progress += $request->input('progress');


        // Check if progress has reached the target
        if ($todo->progress >= $todo->target) {
            $todo->status = 'Finished';
            $todo->save();

            $completedTodo = $user->toDoLists()->where('status', 'Finished')->count();
            if ($completedTodo == 1) {
                $firstTodoAchievement = Achievement::where('title', 'First Step')->first();

                if ($firstTodoAchievement) {
                    $user->achievements()->attach($firstTodoAchievement->id, ['status' => 'Unlocked']);
                }
            } else if ($completedTodo == 5) {
                $fifthTodoAchievement = Achievement::where('title', '5 Done, More to Go')->first();

                if ($fifthTodoAchievement) {
                    $user->achievements()->attach($fifthTodoAchievement->id, ['status' => 'Unlocked']);
                }
            } else if ($completedTodo >= 10) {
                $tenthTodoAchievement = Achievement::where('title', '10 and Still Counting')->first();

                if ($tenthTodoAchievement) {
                    $user->achievements()->attach($tenthTodoAchievement->id, ['status' => 'Unlocked']);
                }
            }
            return redirect()->back()->with('success', 'Progress updated successfully!');
        }
        $todo->save();



        return redirect()->back()->with('success', 'Progress updated successfully!');
    }
}
