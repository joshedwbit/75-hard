@extends('base')

@section('content')

<section>
    <h1>75Hard tracker</h1>

    @auth
    <p class="">Logged in as {{ auth()->user()->name }}</p>
    @include('partials._logout')

    <div class="js-todays-entry">
        @include('partials._new-entry', ['existing_entry' => $todays_entry ? $todays_entry[0] : null, 'new_past_entry' => null, 'edit_entry' => false])
    </div>

    @if ($todays_entry)
    You have drank {{ $todays_entry[0]['water_count']}} bottles of water today, that's {{ $weekly_water_count }} this week!
    @endif

    <h3>Past entries:</h3>

    <button class="">Add a past entry</button>

    <div class="js-past-entry">
        @include('partials._new-entry', ['existing_entry' => null, 'new_past_entry' => true, 'edit_entry' => false])
    </div>

    <form action="/entries-filtered" method="POST">
        @csrf

        <div class="field">
            <label for="filter_date">Filter Date</label>
            <input type="date" id="filter_date" name="filter_date" value={{ date('Y-m-d', strtotime('-1 day')) }} max={{ date('Y-m-d', strtotime('-1 day')) }} min="2020-01-01"/>

            @error('filter_date')
            <p class="error">{{ $message }} </p>
            @enderror
        </div>

        <button type="submit" class="submit">
            Apply
        </button>
    </form>

    @if ($filtered)
    <form action="/home" method="GET">
        <button type="submit">
            Remove filter
        </button>
    </form>
    @endif

    @if (count($logs) == 0)
    No {{ $filtered ? 'results' : 'past entries'}} found.
    @endif

    @foreach($logs as $log)
    @if ($todays_entry && !$filtered)
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

    {{-- <div style="grid-area: date; align-self: center;"><a href="/log/{{$log['id']}}">{{ $log['date'] }}</a></div> --}}
    <div style="grid-area: date; align-self: center;">{{ $log['date'] }}</div>
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