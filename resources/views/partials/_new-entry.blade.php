@php
$max_date = $new_past_entry ? date('Y-m-d', strtotime('-1 day')) : date("Y-m-d");
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

        {{-- todo workout this logic --}}
        <div class="field field--workouts">
            <label for="workouts">Workouts</label>

            <input type="checkbox" name="workouts[]" value="1">1st workout
            <input type="checkbox" name="workouts[]" value="2">2nd workout

            @error('workouts')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="field field--workout-notes">
            <label for="workout_notes">Workout notes</label>

            <textarea name="workout_notes" id="workout_notes" rows="3" cols="50">{{ $existing_entry? $existing_entry['workout_notes'] : '' }}</textarea>

            @error('workout_notes')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        {{-- todo workout this logic --}}
        <div class="field field--water-count">
            <label for="water_count">Water count</label>

            <input type="checkbox" name="water_count[]" value="1">1
            <input type="checkbox" name="water_count[]" value="2">2
            <input type="checkbox" name="water_count[]" value="3">3
            <input type="checkbox" name="water_count[]" value="4">4
            <input type="checkbox" name="water_count[]" value="5">5
            <input type="checkbox" name="water_count[]" value="6">6
            <input type="checkbox" name="water_count[]" value="7">7
            <input type="checkbox" name="water_count[]" value="8">8

            @error('water_count')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="field field--cheat-meals">
            <label for="cheat_meals">Cheat meals (comma separated)</label>

            <textarea name="cheat_meals" id="cheat_meals" rows="3" cols="50">{{ $existing_entry? $existing_entry['cheat_meals'] : '' }}</textarea>

            @error('cheat_meals')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="field field--pages-read">
            <label for="pages_read">Pages read</label>

            <input type="number" step="1" min="0" max="1000" name="pages_read" id="pages_read" value="{{ $existing_entry? $existing_entry['pages_read'] : 0 }}"/>

            @error('pages_read')
            <p class="err">{{$message}}</p>
            @enderror
        </div>

        <div class="field field--general-notes">
            <label for="general_notes">General notes</label>

            <textarea name="general_notes" id="general_notes" rows="3" cols="50">{{ $existing_entry? $existing_entry['general_notes'] : '' }}</textarea>

            @error('general_notes')
            <p class="error">{{$message}}</p>
            @enderror

        </div>

        <div class="submit">
            <button type="submit">
                {{ $edit_entry ? 'Save Changes' : ($existing_entry ? 'Update entry' : 'Save entry') }}
            </button>
        </div>
    </form>