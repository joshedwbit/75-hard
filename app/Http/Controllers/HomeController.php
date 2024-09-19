<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalLog;
use App\Http\Controllers\BaseController;

class HomeController extends BaseController
{
    /**
     * Direct to home view
     *
     * @return void
     */
    public function Home() {
        return view('home', [
            'logs' => PersonalLog::orderBy('date', 'desc')->get(),
        ]);
    }
}
