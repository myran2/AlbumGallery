@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="/css/form.css">
@endsection

@section('content')

<!-- Display Validation Errors -->
@include('common.status')

<div class='content'>
    <h2>Editing "{{$album->title}}"</h2>

    {{ Form::model($album, ['action' => ['App\Http\Controllers\AlbumController@update', $album], 'method' => 'PUT', 'files' => true]) }}
        @include('album.partials.form')
    {{ Form::close() }}

    <!-- Delete -->
    {{ Form::open(['action' => ['App\Http\Controllers\AlbumController@destroy', $album], 'method' => 'DELETE']) }}
        {{ method_field('DELETE') }}
        {{ Form::button('<span>Delete</span>', ['type' => 'submit', 'onclick' => 'return confirm("Delete this album?")', 'class' => ''])}}
    {{ Form::close() }}
</div>

@endsection