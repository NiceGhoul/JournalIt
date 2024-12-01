<?php

namespace App\Http\Controllers;

use App\Models\ToDoList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function showHomePage(){

        $user = Auth::user();
        $today = Carbon::today();
        $todayToDos = ToDoList::where('user_id', $user->id)
            ->whereDate('to_do_date', $today)
            ->where('status', '!=', 'completed')
            ->get();

        $startOfWeek = Carbon::now()->startOfWeek(); 
        $endOfWeek = Carbon::now()->endOfWeek(); 
        $weekToDos = ToDoList::where('user_id', $user->id)
            ->whereBetween('to_do_date', [$startOfWeek, $endOfWeek])
            ->where('status', '!=', 'completed')
            ->get();

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $monthToDos = ToDoList::where('user_id', $user->id)
            ->whereBetween('to_do_date', [$startOfMonth, $endOfMonth])
            ->where('status', '!=', 'completed')
            ->get();

        return view('home', compact('todayToDos', 'weekToDos', 'monthToDos'));
    }
}
