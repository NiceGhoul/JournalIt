<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeditationController extends Controller
{
    //
    public function showMeditationPage(){
        return view('meditation');
    }
}
