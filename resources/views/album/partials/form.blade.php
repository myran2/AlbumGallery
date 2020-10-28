<!-- Album Title -->
{{ Form::label('title', 'Album Title', ['class' => '']) }}
{{ Form::text('title', null, ['class' => '']) }}

<!-- Artist -->
{{ Form::label('artist', 'Artist', ['class' => '']) }}
{{ Form::text('artist', null, ['class' => '']) }}

<!-- Cover Art -->
@if ($album->filename ?? false)
    <div class="album">
        <img src="/img/{{$album->filename}}">
    </div>
@endif
{{ Form::label('filename', 'Cover Art', ['class' => '']) }}
{{ Form::text('filename', null, ['class' => '']) }}

<!-- Save -->
{{Form::button('<span>Save</span>', ['type' => 'submit', 'class' => ''])}}