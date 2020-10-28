@extends('layouts.app')

@section('content')

<!-- Display Validation Errors -->
@include('common.status')

<div class="content">
    @if (count($albums) > 0)
        @foreach ($albums as $album)
        <div class="album">
            <a href="/album/{{$album->id}}/edit">
                <img src="storage/{{$album->image}}">
                <label>{{$album->artist}} - {{$album->title}}</label>
            </a>
        </div>
        @endforeach
    @else
        <p>There are no albums in the database.
        You can create one <a href="/album/create">here</a>.</p>
    @endif
</div>
@endsection