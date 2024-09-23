@extends('base')

@section('content')

<section>
    <h1>75Hard tracker</h1>

    @auth
    <p class="">Logged in as {{ auth()->user()->name }}</p>
    @include('partials._logout')

    @include('partials._new-entry', ['todays_entry' => $todays_entry ? $todays_entry[0] : null, 'new_past_entry' => null])


    <h3>Past entries:</h3>

    <button class="">Add a past entry</button>
    @include('partials._new-entry', ['todays_entry' => null, 'new_past_entry' => true])

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