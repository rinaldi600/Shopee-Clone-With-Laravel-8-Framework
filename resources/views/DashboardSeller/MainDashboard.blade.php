<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="/css/styleDashboardSeller.css" rel="stylesheet">
    <link rel="icon" href="/icons/shopee-logo-31419-16x16.ico" type="ico">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $slogan ?? 'Online Shop' }}</title>
</head>
<body>

@include('DashboardSeller.NavbarDashboard')

@yield('content')

<script src="/js/chart.js"></script>
<script src="/js/script.js"></script>
<script src="/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="/js/JQuery.js"></script>
</body>
</html>
