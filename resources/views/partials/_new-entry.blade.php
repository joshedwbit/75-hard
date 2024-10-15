@php
$max_date = $new_past_entry ? date('Y-m-d', strtotime('-1 day')) : date("Y-m-d");
$waterCount = $existing_entry['water_count'] ?? 0;
$workoutCount = $existing_entry['workouts'] ?? 0;

// could be put in controller/added to db and pulled in model, but fine here for now
$totalWorkoutCheckboxes = 2;
$totalWaterCheckboxes = 8;
@endphp

<h3>{{ $existing_entry ? 'Edit' : 'Add' }} {{ $new_past_entry ? 'past' : ($edit_entry ? '' : 'todays') }} entry:</h3>
    <form method="post" action="{{ $existing_entry ? '/edit-entry/' . $existing_entry['id'] : 'create-entry' }}">
        @csrf
        @if ($existing_entry)
        @method('PUT')
        @endif

        <div class="field field--date">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" value={{ $edit_entry ? $existing_entry['date'] : $max_date }} max={{ $max_date }} min="2020-01-01" {{ $new_past_entry ? '' : 'readonly' }}/>

            @error('date')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="field field--workouts">
            <label for="workouts">Workouts</label>

            @for ($i = 1; $i <= $totalWorkoutCheckboxes; $i++)
            <input type="checkbox" name="workouts[]" value="{{ $i }}" {{ $workoutCount >= $i ? 'checked' : '' }}>workout {{$i}}
            @endfor

            @error('workouts')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="field field--workout-notes">
            <label for="workout_notes">Workout notes</label>

            <textarea name="workout_notes" id="workout_notes" rows="3" cols="50">{{ $existing_entry['workout_notes'] ?? '' }}</textarea>

            @error('workout_notes')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="field field--water-count">
            <label for="water_count">Water count</label>

            @for ($i=1; $i <= $totalWaterCheckboxes; $i++)
            <input type="checkbox" name="water_count[]" value="{{ $i }}" {{ $waterCount >= $i ? 'checked' : '' }}>{{ $i}}
            @endfor

            @error('water_count')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="field field--cheat-meals">
            <label for="cheat_meals">Cheat meals (comma separated)</label>

            <textarea name="cheat_meals" id="cheat_meals" rows="3" cols="50">{{ $existing_entry['cheat_meals'] ?? '' }}</textarea>

            @error('cheat_meals')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="field field--pages-read">
            <label for="pages_read">Pages read</label>

            <input type="number" step="1" min="0" max="1000" name="pages_read" id="pages_read" value="{{ $existing_entry['pages_read'] ?? 0 }}"/>

            @error('pages_read')
            <p class="err">{{$message}}</p>
            @enderror
        </div>

        <div class="field field--general-notes">
            <label for="general_notes">General notes</label>

            <textarea name="general_notes" id="general_notes" rows="3" cols="50">{{ $existing_entry['general_notes'] ?? '' }}</textarea>

            @error('general_notes')
            <p class="error">{{$message}}</p>
            @enderror

        </div>

        <div class="submit">
            <button type="submit">
                {{ $edit_entry ? 'Save Changes' : ($existing_entry ? 'Update entry' : 'Save entry') }}
            </button>
        </div>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </form>