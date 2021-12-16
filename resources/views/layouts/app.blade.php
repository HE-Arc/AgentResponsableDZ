<!DOCTYPE html>

<title>ARDZ</title>
<link href="/css/main.css" rel="stylesheet">
<body>
    @include('layouts.header')
    <div id="content">
        @yield("content")
    </div>
    @include("layouts.footer")
</body>

