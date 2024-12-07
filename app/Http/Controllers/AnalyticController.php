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

        $dates = collect();
        for ($i = 9; $i >= 0; $i--) {
            $dates->push(now()->subDays($i)->format('Y-m-d'));
        }

        $history = $dates->mapWithKeys(function ($date) use ($data) {
            $completed = $data->where('date_added', $date)->where('status', 'completed')->count();
            $ongoing = $data->where('date_added', $date)->where('status', 'ongoing')->count();

            return [$date => [
                'completed' => $completed,
                'ongoing' => $ongoing,
            ]];
        });
        
        $total = $data->count();
        $completed = $data->where('status', 'completed')->count();
        $ongoing = $data->where('status', 'ongoing')->count();

        return response()->json([
            'total' => $total,
            'completed' => $completed,
            'ongoing' => $ongoing,
            'history' => $history,
        ]);
    }

}
