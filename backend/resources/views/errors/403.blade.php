<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forbidden - {{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="flex justify-center items-center bg-gray-800 min-h-screen">
    <div class="text-center">
        <div class="mb-8">
            <h1 class="font-bold text-yellow-600 text-9xl">403</h1>
            <h2 class="mt-4 font-semibold text-white text-3xl">Access Forbidden</h2>
            <p class="mt-2 text-gray-300">You don't have permission to access this resource.</p>
        </div>

        <div class="space-y-4">
            <a href="{{ url('/') }}"
                class="inline-block bg-orange-600 hover:bg-orange-700 px-6 py-3 rounded-lg font-medium text-white transition-colors">
                Go Home
            </a>

            @auth
            <div class="mt-4">
                <p class="text-gray-400 text-sm">
                    Logged in as: <span class="font-medium text-orange-400">{{ Auth::user()->full_name }}</span>
                    ({{ ucfirst(Auth::user()->role) }})
                </p>
            </div>
            @else
            <div class="space-x-4 mt-4">
                <a href="{{ route('login') }}"
                    class="text-orange-400 hover:text-orange-300 transition-colors">Login</a>
                <a href="{{ route('register') }}"
                    class="text-orange-400 hover:text-orange-300 transition-colors">Register</a>
            </div>
            @endauth
        </div>
    </div>
</body>

</html>