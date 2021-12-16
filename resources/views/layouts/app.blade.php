<!DOCTYPE html>

<title>ARDZ</title>
<link href="/css/main.css" rel="stylesheet">
<script src="https://kit.fontawesome.com/4911d95292.js" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<body>
    @include('layouts.header')
    <div id="content">
        @yield("content")
    </div>
    @include("layouts.footer")
</body>

