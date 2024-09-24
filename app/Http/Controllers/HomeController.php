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
        $weeklyWaterCount = 0;
        if (self::isLoggedIn()) {
            $logs = auth('web')->user()->userLogs()->orderBy('date', 'desc')->get();

            $todaysEntryQuery= PersonalLog::getTodaysEntryQuery();

            $weeklyWaterCount = PersonalLog::getWeeklyWaterCount();
        }

        return view('home', [
            'logs' => $logs,
            'todays_entry' => $todaysEntryQuery->exists() ? $todaysEntryQuery->get() : null,
            'filtered' => false,
            'weeklyWaterCount' => $weeklyWaterCount,
        ]);
    }
}
