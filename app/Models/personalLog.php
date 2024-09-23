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
        $userId = auth('web')->id();

        $startOfWeek = Carbon::now()->startOfWeek();

        $weeklyLogs = PersonalLog::where('user_id', $userId)
                                // ->where('date', '>=', Carbon::now()->subDays(7))
                                ->where('date', '>=', $startOfWeek)
                                ->get();

        return $weeklyLogs->sum('water_count');
    }
}
