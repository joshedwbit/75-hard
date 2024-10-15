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
