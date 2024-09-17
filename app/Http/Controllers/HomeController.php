<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalLog;

class HomeController extends Controller
{
    public function Home() {
        return view('home', [
            'logs' => PersonalLog::orderBy('date', 'desc')->get(),
        ]);
    }
}
