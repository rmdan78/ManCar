<!DOCTYPE html>

<html
    x-data="initialData"
    :data-theme="dark ? 'dark' : null"
    lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0" />
        <meta
            http-equiv="X-UA-Compatible"
            content="ie=edge" />
        <link
            rel="icon"
            href="/images/logo.webp" />
        <title>@yield('title', 'HMA Vehicle Booking')</title>
        <link
            href="//fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet" />
        <link
            href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i"
            rel="stylesheet" />

        @vite(['resources/css/layouts/guest/index.css'])
        @yield('head')
    </head>
    <body>
        @yield('content')
        @vite(['resources/js/layouts/guest/index.js'])
    </body>
</html>
