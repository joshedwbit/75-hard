@extends('base')

@section('content')

@php
if ($todays_entry) {
    $todays_entry_log = $todays_entry[0];
}
@endphp

<section>
    <h1>75Hard tracker</h1>

    @auth
    <p class="">Logged in as {{ auth()->user()->name }}</p>
    @include('partials._logout')

    <h3>{{ $todays_entry ? 'Edit' : 'Add' }} todays entry:</h3>
    {{-- if todays entry exists, display it and add option to edit  --}}
    <form method="post" action="{{ $todays_entry ? '/edit-entry/' . $todays_entry_log['id'] : 'create-entry' }}">
        @csrf
        @if ($todays_entry)
        @method('PUT')
        @endif

        <div class="field field--date">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" value={{ date("Y-m-d") }} max={{ date("Y-m-d")}} min="2020-01-01" {{ $todays_entry ? 'readonly' : '' }}/>

            @error('date')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

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

            <textarea name="workout_notes" id="workout_notes" rows="3" cols="50">{{ $todays_entry? $todays_entry_log['workout_notes'] : '' }}</textarea>

            @error('workout_notes')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

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

            <textarea name="cheat_meals" id="cheat_meals" rows="3" cols="50">{{ $todays_entry? $todays_entry_log['cheat_meals'] : '' }}</textarea>

            @error('cheat_meals')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="field field--pages-read">
            <label for="pages_read">Pages read</label>

            <input type="number" step="1" min="0" max="1000" name="pages_read" id="pages_read" value="{{ $todays_entry? $todays_entry_log['pages_read'] : 0 }}"/>

            @error('pages_read')
            <p class="err">{{$message}}</p>
            @enderror
        </div>

        <div class="field field--general-notes">
            <label for="general_notes">General notes</label>

            <textarea name="general_notes" id="general_notes" rows="3" cols="50">{{ $todays_entry? $todays_entry_log['general_notes'] : '' }}</textarea>

            @error('general_notes')
            <p class="error">{{$message}}</p>
            @enderror

        </div>

        <div class="submit">
            <button type="submit">
                {{ $todays_entry ? 'Update' : 'Save' }} entry
            </button>
        </div>
    </form>

    <h3>Past entries:</h3>

    @foreach($logs as $log)
    @if ($todays_entry)
        @if ($loop->first)
            @continue
        @endif
    @endif
    <div style="
    width:1000px;
    display:grid;
    grid-template-areas:
    'date workouts_header water_header pages_header edit delete'
    'date workouts water_count pages edit delete';
    grid-template-rows: auto;
    grid-template-columns: 2fr 2fr 2fr 2fr 1fr 1fr;
    justify-items: center;
    justify-content: start;
    padding: 50px 0;">
    <div style="grid-area: workouts_header;">Workouts</div>
    <div style="grid-area: water_header;">Water count</div>
    <div style="grid-area: pages_header;">Pages read</div>

    <div style="grid-area: date; align-self: center;"><a href="/log/{{$log['id']}}">{{ $log['date'] }}</a></div>
    <div style="grid-area: workouts;">{{$log['workouts']}}</div>
    <div style="grid-area: water_count;">{{$log['water_count']}}</div>
    <div style="grid-area: pages;">{{$log['pages_read']}}</div>

    <div style="grid-area: edit; align-self: center;">
        <a href="/edit-entry/{{$log['id']}}" class="">Edit</a>
    </div>

    <div style="grid-area: delete; align-self: center;">
        <form action="/delete-entry/{{$log['id']}}" method="POST" class="">
            @csrf
            @method('DELETE')
            <button class="">Remove</button>
        </form>
    </div>
    </div>

    @endforeach
    @else
    <p class="">Please select one of the following</p>
    <a href="/login">Login</a>
    <a href="/register">Sign up</a>
    @endauth
</section>
@endsection