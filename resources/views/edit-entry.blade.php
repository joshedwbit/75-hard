@extends('base')

@section('content')
<section class="">
    @include('partials._new-entry', ['existing_entry' => $log, 'new_past_entry' => null, 'edit_entry' => true])

    <a href="/home" class="">Back to homepage</a>
</section>
@endsection