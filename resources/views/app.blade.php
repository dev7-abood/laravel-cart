@php
    $segments = request()->segments();
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <script src="{{ mix('/js/app.js') }}" defer></script>
    @if($segments[0] == 'main')
        <x-main.head-component/>
    @endif
</head>
<body>
@inertia
@if($segments[0] == 'main')
<x-main.script-component/>
@endif
</body>
</html>
