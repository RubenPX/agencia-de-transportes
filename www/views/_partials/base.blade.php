<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap.darkly.min.css">
    <title>@yield('titulo')</title>
</head>
<body>
    @include('_partials.header')
    @yield('content')
</body>
</html>