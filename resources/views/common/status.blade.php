@if (Session::has('success'))
    <div class="alert alert-success active" role="alert" onclick="hideElement(this)">
        <p>{{ Session::get('success') }} (Click to Dismiss)</p>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-fail active" role="alert" onclick="hideElement(this)">
        @foreach ( $errors->all() as $error )
            <p>Error: {{ $error }} (Click to Dismiss)</p>
        @endforeach
    </div>
@endif