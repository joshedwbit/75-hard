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
        $todaysEntryQuery = PersonalLog::query();
        if (self::isLoggedIn()) {
            $logs = auth('web')->user()->userLogs()->orderBy('date', 'desc')->get();

            $todaysEntryQuery= PersonalLog::where('date', date("Y-m-d"))
                                        ->where('user_id', auth('web')->id());
        }

        return view('home', [
            'logs' => $logs,
            'todays_entry' => $todaysEntryQuery->exists() ? $todaysEntryQuery->get() : null,
        ]);
    }
}
