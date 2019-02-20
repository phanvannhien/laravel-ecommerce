<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>
</head>
<body>
    <div id="app">
        <router-view></router-view>
    </div>
    <script type="text/javascript" src="{{ url('js/app.js') }}"></script>

</body>
</html>

