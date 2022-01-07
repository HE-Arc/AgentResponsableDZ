<!DOCTYPE html>

<title>ARDZ</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link href=" {{ asset('css/main.css') }}" rel="stylesheet" type="text/css">
<!-- JS only -->
<script src="https://kit.fontawesome.com/4911d95292.js" crossorigin="anonymous"></script>
<body>
    @include('layouts.header')
    <div class="container">
        <div id="content">
            @yield("content")
        </div>
    </div>
        @include("layouts.footer")
    @stack('scripts')
</body>

