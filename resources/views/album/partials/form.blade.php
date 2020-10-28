<!-- Album Title -->
{{ Form::label('title', 'Album Title', ['class' => '']) }}
{{ Form::text('title', null, ['class' => '']) }}

<!-- Artist -->
{{ Form::label('artist', 'Artist', ['class' => '']) }}
{{ Form::text('artist', null, ['class' => '']) }}

<!-- Cover Art -->
@if ($album->image ?? false)
    <div class="album">
        <img src="/img/{{$album->image}}">
    </div>
@endif
{{ Form::label('image', 'Cover Art', ['class' => '']) }}
{{ Form::file('image', null, ['class' => '']) }}

<!-- Save -->
{{Form::button('<span>Save</span>', ['type' => 'submit', 'class' => ''])}}