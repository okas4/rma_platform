<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles personnalisés -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #4B0082, #ab8ec0); /* dégradé indigo */
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            width: 100%;
            max-width: 400px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            padding: 30px;
            margin: 20px;
        }

        .logo {
            display: block;
            margin: 0 auto 20px auto;
            width: 60px;
            height: auto;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container">
        <div class="card">
            <!-- Logo -->
            <a href="/">
                <x-application-logo class="logo" />
            </a>

            <!-- Slot du formulaire -->
            {{ $slot }}
        </div>
    </div>
</body>
</html>
