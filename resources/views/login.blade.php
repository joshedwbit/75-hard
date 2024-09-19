@extends('base')

@section('content')

<section>

    @auth
    <p>You are already logged in!</p>
    @include('partials._logout')
    @else
    <form method="POST" action="/login">
        @csrf

        <div class="field field--email">
            <label for="email">Email</label>

            <input type="text" id="email" name="email">

            @error('email')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="field">
            <label for="password">Password</label>

            <input type="password" id="password" name="password">

            @error('password')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <button type="submit">
            Login
        </button>
    </form>
    <aside>Don't have an account? <a href="/register" class="">Register for an account</a></aside>
    @endauth


</section>
@endsection