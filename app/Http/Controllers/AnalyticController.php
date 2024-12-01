<?php

namespace App\Http\Controllers;

use App\Models\Meditation;
use App\Models\ToDoList;
use Auth;
use Illuminate\Http\Request;

class AnalyticController extends Controller
{
    //
    public function showAnalyticPage()
    {
        
        return view('analytics.analytics');
    }

    public function fetchData(Request $request)
    {
        $userId = Auth::id(); 
        $category = $request->input('category'); 

        if ($category === 'meditation') {
            $data = Meditation::where('user_id', $userId)->get();
        } else {
            $data = ToDoList::where('user_id', $userId)->get();
        }

        $total = $data->count();
        $completed = $data->where('status', 'completed')->count();
        $ongoing = $data->where('status', 'ongoing')->count();

        $history = $data->groupBy('done_date')->map(function ($group) {
            return [
                'completed' => $group->where('status', 'completed')->count(),
                'ongoing' => $group->where('status', 'ongoing')->count(),
            ];
        })->sortKeys(); 

        return response()->json([
            'total' => $total,
            'completed' => $completed,
            'ongoing' => $ongoing,
            'history' => $history,
        ]);
    }
}
