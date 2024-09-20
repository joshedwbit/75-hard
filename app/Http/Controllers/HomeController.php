<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalLog;
use App\Http\Controllers\BaseController;
use App\Models\User;

class HomeController extends BaseController
{
    /**
     * Direct to home view
     *
     * @return void
     */
    public function Home() {
        $logs = [];
        if (self::isLoggedIn()) {
            $logs = auth('web')->user()->userLogs()->latest()->get();
        }

        return view('home', [
            'logs' => $logs,
        ]);
    }
}
