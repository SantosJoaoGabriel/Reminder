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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#181928]">

    <!-- HEADER  -->
    <header class="w-full bg-[#181928] py-4 px-6 flex items-center justify-between shadow-lg border-b-2 border-blue-700">
        <div>
            <img src="{{ asset('https://th.bing.com/th/id/OIP.Lddo6-yQCJntaifsBG1tLgHaHa?w=184&h=185&c=7&r=0&o=7&dpr=1.3&pid=1.7&rm=3') }}" alt="Logo" class="h-10 w-10 rounded-xl shadow-lg" />
        </div>
        <div class="flex-1 text-center">
            <span class="text-3xl font-extrabold text-blue-300 tracking-wide drop-shadow">Weather Reminder</span>
        </div>
        <div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-xl shadow transition">
                    Logout
                </button>
            </form>
        </div>
    </header>
    
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 pt-20 relative">
        <livewire:layout.navigation />
        @if (isset($header))
            <header class="bg-[#181928] shadow-none">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <main>
            @yield('slot')
        </main>
    </div>
</body>
</html>