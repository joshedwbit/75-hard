@extends('base')

@section('content')
<section>
    @auth
    <p>You are already logged in!</p>
    @include('partials._logout')
    @else

    <form action="/new-user" method="POST">
        @csrf

        <div class="field field--name">
            <label for="name">Name</label>
            <input type="text" id="name" name="name">

            @error('name')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="field field--email">
            <label for="email">Email</label>
            <input type="text" id="email" name="email">

            @error('email')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="field field--password">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">

            @error('password')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <button type="submit" class="submit">
            Register
        </button>
    </form>
    <aside>Already have an account? <a href="/login" class="">Click here to log in</a></aside>
    @endauth
</section>
@endsection