@extends('layouts.app')

@section('content')

<!-- Display Validation Errors -->
@include('common.status')

<div class="content">
    @foreach ($albums as $album)
    <div class="album">
        <a href="/album/{{$album->id}}/edit">
            <img src="img/{{$album->filename}}">
            <label>{{$album->artist}} - {{$album->title}}</label>
        </a>
    </div>
    @endforeach
</div>
@endsection