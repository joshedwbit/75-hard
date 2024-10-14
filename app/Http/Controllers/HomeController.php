<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PersonalLog;
use App\Http\Controllers\BaseController;
use Carbon\Carbon;

class HomeController extends BaseController
{
    /**
     * Direct to home view
     *
     * @return void
     */
    public function Home() {
        $thisWeeksLogs = [];
        $todaysEntryQuery = PersonalLog::query();
        $weeklyWaterCount = 0;
        $startOfCurrentWeek = Carbon::now()->startOfWeek();
        $isMonday = Carbon::now()->isMonday();

        if (self::isLoggedIn()) {
            $thisWeeksLogs = auth('web')->user()->userLogs()
                ->where('date', '>=', $startOfCurrentWeek)
                ->orderBy('date', 'desc')
                ->get();

            $todaysEntryQuery= PersonalLog::getTodaysEntryQuery();

            $weeklyWaterCount = PersonalLog::getWeeklyWaterCount();
        }

        return view('home', [
            'this_weeks_logs' => $thisWeeksLogs,
            'todays_entry' => $todaysEntryQuery->exists() ? $todaysEntryQuery->get() : null,
            'filtered' => false,
            'weekly_water_count' => $weeklyWaterCount,
            'is_monday' => $isMonday,
        ]);
    }
}
