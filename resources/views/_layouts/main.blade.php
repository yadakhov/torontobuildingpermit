<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    @if (isset($title))
        <title>{{ $title.' - TorontoBuildingPermit.info' }}</title>
    @else
        <title>TorontoBuildingPermit.info</title>
    @endif
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Loading Flat UI -->
    <link href="/css/flat-ui.css" rel="stylesheet">
    <link rel="shortcut icon" href="/img/favicon.ico">

    <!--[if lt IE 9]>
    <script src="/js/vendor/html5shiv.js"></script>
    <script src="/js/vendor/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<style>
    body {
        min-height: 2000px;
    }

    .navbar-static-top {
        margin-bottom: 19px;
    }
</style>

<!-- Static navbar -->
<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
            </button>
            <a class="navbar-brand" href="{{ route('front') }}">TorontoBuildingPermit.info</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li @if(Route::is('search')) class="active" @endif><a href="{{ route('search') }}">Search</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li @if(Route::is('about')) class="active" @endif><a href="{{ route('about') }}">About</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>


<div class="container">

@yield('content')

</div>

<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<script src="/js/flat-ui.min.js"></script>
<script src="/js/app.js"></script>

</body>
</html>
