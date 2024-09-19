<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalLog;

class LogController extends Controller
{
    /**
     * Handle entry submission
     *
     * @param Request $request
     * @return void
     */
    public function entrySubmitted(Request $request)
    {
        $submittedFields = $this->validateLogFields($request);

        PersonalLog::create($submittedFields);

        return redirect('/home');
    }

    /**
     * Validate entry submissions
     *
     * @param Request $request
     * @return void
     */
    public function validateLogFields(Request $request)
    {
        $submittedFields = $request->validate([
            'date' => 'required',
            'workouts' => 'nullable|array',
            'workouts*' => 'integer|in:1,2',
            'workout_notes' => 'nullable|string|max:100',
            'water_count' => 'nullable|array',
            'water_count*' =>'integer|between:1,8',
            'cheat_meals' => 'nullable|string|max:100',
            'pages_read' => 'nullable|integer|between:0,1000',
            'general_notes' => 'nullable|string|max:300',
        ]);

        $submittedFields['workouts'] = isset($submittedFields['workouts']) ? sizeof($submittedFields['workouts']) : 0;
        $submittedFields['water_count'] = isset($submittedFields['water_count']) ? sizeof($submittedFields['water_count']) : 0;

        return $submittedFields;
    }
}
