<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css">
    <!-- Buttons CSS -->
    <link rel="stylesheet" href="{{ asset('build/assets/DataTables/buttons.dataTables.min.css') }}">




    <!-- jQuery -->
    <script src="{{ asset('build/assets/DataTables/jquery-3.7.1.js') }}"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('build/assets/DataTables/datatables.min.css') }}">


    <!-- DataTables JS -->
    <script src="{{ asset('build/assets/DataTables/dataTables.min.js') }}"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])



</head>
<style>
    .nav-tabs .nav-link.active {
        background-color: #4B0082;
        color: white !important;
        border-radius: 5px 5px 0 0;
    }

    .nav-tabs .nav-link:hover:not(.active):not(.disabled) {
        background-color: #e9ecef;
        transition: 0.3s ease;

        .bg-indigo-light {
            background-color: rgba(99, 101, 241, 0.26);

        }

        .card-indigo {
            background-color: #4B0082;

            color: white;
        }

        .card-indigo h6 {
            color: rgba(230, 230, 230, 0.692);

        }
    }
</style>


<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @if (auth()->user() && auth()->user()->role == 'admin')
            @include('layouts.navigation2')
        @else
            @include('layouts.navigation')
        @endif


        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main >
            {{ $slot }}
        </main>
    </div>
    <script src="https://unpkg.com/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    @stack('scripts')

</body>

</html>
