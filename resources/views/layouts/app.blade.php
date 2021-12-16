<!DOCTYPE html>

<title>ARDZ</title>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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

