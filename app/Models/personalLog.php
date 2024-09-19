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
}
