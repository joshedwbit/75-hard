@extends('base')

@section('content')
<section class="">
    <div class="js-edit-entry">
        @include('partials._new-entry', ['existing_entry' => $log, 'new_past_entry' => null, 'edit_entry' => true])
    </div>

    <a href="/home" class="">Back to homepage</a>
</section>
@endsection