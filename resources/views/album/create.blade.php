@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="/css/form.css">
@endsection

@section('content')

<!-- Display Validation Errors -->
@include('common.status')

<div class='content'>
    <h2>Add an Album</h2>

    {{ Form::model(new App\Models\Album, ['action' => ['App\Http\Controllers\AlbumController@store'], 'files' => true]) }}
        @include('album.partials.form')
    {{ Form::close() }}
</div>

@endsection