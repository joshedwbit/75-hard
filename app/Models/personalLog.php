<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
