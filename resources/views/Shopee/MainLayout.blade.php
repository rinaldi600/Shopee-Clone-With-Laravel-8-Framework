<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/homeShopee.css" rel="stylesheet">
    <link rel="icon" href="/icons/shopee-logo-40483-16x16.ico">

    <title>{{ $title ?? 'Shopee Indonesia | Jual Beli di Ponsel dan Online' }}</title>
</head>
<body>
@include('Shopee.Navbar')
@yield('content')
@include('Shopee.Footer.FooterView')

<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/shopee.js"></script>
<script src="/js/JQuery.js"></script>
</body>
</html>
