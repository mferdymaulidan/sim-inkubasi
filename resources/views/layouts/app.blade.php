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
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body class="font-sans antialiased" x-data={sideBarOpen:false}>
        <div class="min-h-screen bg-gray-100 grid grid-cols-1 md:grid-cols-1 gap-2">
            @include('layouts.navigation')

            <aside class="mt-16 bg-blue-150 max-w-xs sm:block hidden lg:fixed h-full" :class="sideBarOpen ? 'w-64' : 'w-16'">
                @include('layouts.sidebar')
            </aside>

            <!-- Page Content -->
            <main>
                <div class="px-7 py-3" :class="sideBarOpen ? 'lg:ml-64' : 'lg:ml-16'">
                     @isset($header)
                        <header class="bg-blue-600 shadow mt-16 pl-5">
                            <div class="max-w-7xl py-6 sm:px-6">
                                {{ $header }}
                            </div>
                        </header>
                    @endisset
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
