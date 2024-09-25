<?php

namespace App\Http\Controllers;

use App\Models\PersonalLog;
use Illuminate\Http\Request;

class LogController extends BaseController
{
    /**
     * Handle entry submission
     *
     * @param Request $request
     * @return void
     */
    public function createEntry(Request $request)
    {
        $existingRecord = PersonalLog::where('date', $request['date'])
                                    ->where('user_id', auth('web')->id())
                                    ->exists();

        if ($existingRecord) {
            return back()->withErrors([
                'date' => 'An entry for that date already exists!'
            ]);
        }

        $submittedFields = $this->cleanLogFields($request);

        PersonalLog::create($submittedFields);

        return redirect('/home');
    }

    /**
     * Validate entry submissions
     *
     * @param Request $request
     * @return array
     */
    public function cleanLogFields(Request $request, $new=true)
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

        $submittedFields['workout_notes'] = strip_tags($submittedFields['workout_notes']);
        $submittedFields['cheat_meals'] = strip_tags($submittedFields['cheat_meals']);
        $submittedFields['general_notes'] = strip_tags($submittedFields['general_notes']);

        if ($new) {
            $submittedFields['user_id'] = auth('web')->id();
        }

        return $submittedFields;
    }

    /**
     * Direct to edit view
     *
     * @param PersonalLog $log
     * @return void
     */
    public function editEntry(PersonalLog $log)
    {
        if (!$this->userMatchesLog($log)) {
            return redirect('/home');
        }

        return view('edit-entry', [
            'log' => $log,
        ]);
    }

    /**
     * Update an existing entry
     *
     * @param PersonalLog $log
     * @param Request $request
     * @return void
     */
    public function updateEntry(PersonalLog $log, Request $request)
    {
        if ($this->userMatchesLog($log)) {
            $submittedFields = $this->cleanLogFields($request, false);

            $log->update($submittedFields);
        }

        return redirect('/home');
    }

    /**
     * Check if the user ID matches the log ID
     *
     * @param PersonalLog $log
     * @return bool
     */
    public function userMatchesLog(PersonalLog $log)
    {
        return auth('web')->user()->id === $log['user_id'];
    }

    /**
     * Delete entry
     *
     * @param PersonalLog $log
     * @return void
     */
    public function deleteEntry(PersonalLog $log)
    {
        if ($this->userMatchesLog($log)) {
            $log->delete();
        }

        return redirect('/home');
    }

    /**
     * Filter logs
     *
     * @param Request $request
     * @return void
     */
    public function filterEntries(Request $request)
    {
        if (!self::isLoggedIn()) {
            return redirect('/home');
        }

        $request->validate([
            'filter_date' => 'required',
        ]);

        $filteredQuery = PersonalLog::where('date', $request['filter_date'])
                                    ->where('user_id', auth('web')->id());

        $todaysEntryQuery = PersonalLog::getTodaysEntryQuery();
        $weeklyWaterCount = PersonalLog::getWeeklyWaterCount();

        return view('home', [
            'logs' => $filteredQuery->get(),
            'todays_entry' => $todaysEntryQuery->exists() ? $todaysEntryQuery->get() : null,
            'filtered' => true,
            'weeklyWaterCount' => $weeklyWaterCount,
            'filtered_date' => $request['filter_date'],
        ]);
    }
}
