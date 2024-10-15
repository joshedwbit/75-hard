<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonalLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'workouts',
        'workout_notes',
        'water_count',
        'cheat_meals',
        'pages_read',
        'general_notes',
        'user_id',
    ];

    /**
     * Explain relationship between users and logs
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * pull todays entry from the db if it exists
     *
     * @return void
     */
    public static function getTodaysEntryQuery()
    {
        return self::where('date', date("Y-m-d"))
                    ->where('user_id', auth('web')->id());
    }

    /**
     * Get the water count for the current week
     *
     * @return integer
     */
    public static function getWeeklyWaterCount()
    {
        return self::getSummaries('water_count', Carbon::now()->startOfWeek());
    }

    /**
     * Get the water count for the current month
     *
     * @return int
     */
    public static function getMonthlyWaterCount()
    {
        return self::getSummaries('water_count', Carbon::now()->startOfMonth());
    }

    /**
     * Get the all time water count
     *
     * @return int
     */
    public static function getAllTimeWaterCount()
    {
        return self::getSummaries('water_count');
    }

    /**
     * Get the workout count for the current week
     *
     * @return int
     */
    public static function getWeeklyWorkoutCount()
    {
        return self::getSummaries('workouts', Carbon::now()->startOfWeek());
    }

    /**
     * Get the workout count for the current month
     *
     * @return int
     */
    public static function getMonthlyWorkoutCount()
    {
        return self::getSummaries('workouts', Carbon::now()->startOfMonth());
    }

    /**
     * Get the all time workout count
     *
     * @return int
     */
    public static function getAllTimeWorkoutCount()
    {
        return self::getSummaries('workouts');
    }

    /**
     * Get the pages read count for the current week
     *
     * @return int
     */
    public static function getWeeklyPagesReadCount()
    {
        return self::getSummaries('pages_read', Carbon::now()->startOfWeek());
    }

    /**
     * Get the pages read count for the current month
     *
     * @return int
     */
    public static function getMonthlyPagesReadCount()
    {
        return self::getSummaries('pages_read', Carbon::now()->startOfMonth());
    }

    /**
     * Get the all time pages read count
     *
     * @return int
     */
    public static function getAllTimePagesReadCount()
    {
        return self::getSummaries('pages_read');
    }

    /**
     * Get total days logged
     *
     * @return int
     */
    public static function getTotalDaysLogged()
    {
        return count(auth('web')->user()->userLogs()->get());
    }

    /**
     * Get a users longest streak
     *
     * @return int
     */
    public static function getLongestStreak()
    {
        $logs = auth('web')->user()->userLogs()->orderBy('date', 'asc')->pluck('date');

        if ($logs->isEmpty()) {
            return 0;
        }

        $longestStreak = 1;
        $currentStreak = 1;

        for ($i = 1; $i < $logs->count(); $i++) {
            $currentDate = Carbon::parse($logs[$i]);
            $previousDate = Carbon::parse($logs[$i - 1]);

            if ($previousDate->diffInDays($currentDate) == 1) {
                $currentStreak++;
            } else {
                $longestStreak = max($longestStreak, $currentStreak);
                $currentStreak = 1; // Reset streak count
            }
        }

        $longestStreak = max($longestStreak, $currentStreak);

        return $longestStreak;
    }


    /**
     * Get a users current streak
     *
     * @return int
     */
    public static function getCurrentStreak()
    {
        $logs = auth('web')->user()->userLogs()->orderBy('date', 'desc')->pluck('date');

        if ($logs->isEmpty()) {
            return 0;
        }

        $todaysDate = Carbon::today();
        $currentStreak = 1;

        for ($i = 0; $i < ($logs->count() - 1); $i++) {
            $latestDate = Carbon::parse($logs[$i]);
            $previousDate = Carbon::parse($logs[$i + 1]);

            if ($i==0 && $latestDate != $todaysDate) {
                return 0;
            }

            if ($previousDate->diffInDays($latestDate) == 1) {
                $currentStreak++;
            } else {
                break;
            }
        }

        return $currentStreak;
    }


    /**
     * Get Summaries for a specified field and time period
     *
     * @param Carbon|null $timePeriod
     * @return int
     */
    public static function getSummaries($field, $timePeriod = null)
    {
        $query = auth('web')->user()->userLogs();

        if ($timePeriod) {
            $query->where('date', '>=', $timePeriod);
        }

        return $query->sum($field);
    }
}
