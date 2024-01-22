<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .fakeimg {
            height: 200px;
            background: #aaa;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a class="navbar-brand" href="{{ url('') }}">Research</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
            <li class="nav-item">
                    <a class="nav-link" href="{{ url('map') }}">Peta Risiko</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('enkripsi') }}">Enkripsi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('zigzag') }}">Zigzag</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('zigzag/vfoo') }}">Foo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('zigzag/vbar') }}">Bar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('weton') }}">Buzz</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid" style="margin-top:30px">
        @yield('content')
    </div>
</body>
