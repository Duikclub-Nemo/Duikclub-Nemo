<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      class="scrollbar-thin">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Duikclub App') }}</title>
    <meta name="description"
          content="De website van Duikclub Nemo. Duikclub Nemo heeft als doel mensen zodanig op te leiden dat ze zelfstandig over de hele wereld kunnen duiken en daarnaast voor de bestaande leden de mogelijkheid bied om op een leuke manier bezig te zijn met de duiksport, zich verder te kunnen specialiseren en de vereiste basisconditie op peil te kunnen houden."/>
    <meta name="keywords"
          content="DCNemo, Duikschool, Nemo, Duikclub, Duiken, Scuba, Opleidingen, Cursus, Parkstad, Landgraaf, Heerlen, Kerkrade, CMAS, NOB, Nederlandse Onderwatersport Bond, Onderwater"/>
    <meta name="author" content="Wesie.NET Multimedia Solutions"/>
    <meta name="robots" content="index, follow"/>
    <meta name="revisit-after" content="7 days"/>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap"
          rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&family=Oleo+Script:wght@400;700&display=swap"
        rel="stylesheet">

    <!-- Logos -->
    <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">

    <!-- iOS Support -->
    <meta name="apple-mobile-web-app-status-bar" content="#4F9FD5">
    <meta name="theme-color" content="#1e567b" media="(prefers-color-scheme: light)">

    <!-- PWA Manifest -->
    <link rel="manifest" href="/manifest.json"/>

    <!-- Scripts -->
    @routes
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @inertiaHead
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-600">
@inertia
</body>
</html>
