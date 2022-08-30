<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="/css/style.css" rel="stylesheet">
    <link rel="icon" href="/icons/shopee-logo-31419-16x16.ico" type="ico">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $slogan ?? 'Online Shop' }}</title>
</head>
<body>

    <div class="navbar mx-auto">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center flex-wrap">
                <img class="img-fluid" src="/img/6102dc563de48b00044eb5b3.png">
                <h1 class="fs-2">{{ $title }}</h1>
            </div>
            <div class="d-flex align-items-center">
                <a class="text-decoration-none text-nowrap" href=""><p>Butuh Bantuan ?</p></a>
            </div>
        </div>
    </div>
    @yield('content')

<script src="/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
