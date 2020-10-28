<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{config('app.name')}}</title>
        <link rel="stylesheet" type="text/css" href="/css/reset.css">
        <link href='https://fonts.googleapis.com/css?family=Red Hat Display' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="/css/app.css">
        @yield('css')

    </head>
    <body>
        <header>
            <h1><a href="/">{{config('app.name')}}</a></h1>
            <div class="nav">
                <a href="/">Gallery</a>
                <span>|</span>
                <a href="/album/create">Add New Album</a>
            </div>
        </header>
        @yield('content')
         <footer>
            Henry Gordon's code test for Atlas Networks
         </footer>
    </body>
</html>