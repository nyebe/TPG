<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-800 min-h-screen text-white">
    <!-- Header -->
    <header class="bg-gray-900 shadow-lg">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <h1 class="font-bold text-white text-xl">{{ config('app.name', 'Laravel') }}</h1>
                </div>
                <nav class="flex items-center space-x-4">
                    @auth
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-300 text-sm">
                            Welcome, {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                        </span>
                        <span class="inline-flex items-center bg-orange-100 px-2.5 py-0.5 rounded-full font-medium text-orange-800 text-xs">
                            {{ ucfirst(auth()->user()->role) }}
                        </span>
                        <form method="POST" action="{{ url('/logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="inline-block bg-orange-600 hover:bg-orange-700 px-4 py-2 rounded-md font-medium text-white text-sm transition-colors">
                                Logout
                            </button>
                        </form>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="inline-block px-4 py-2 font-medium text-gray-300 hover:text-white text-sm">
                        Log in
                    </a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="inline-block bg-orange-600 hover:bg-orange-700 px-4 py-2 rounded-md font-medium text-white text-sm transition-colors">
                        Register
                    </a>
                    @endif
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="mx-auto px-4 sm:px-6 lg:px-8 py-6 max-w-7xl">
        <!-- Status Messages -->
        @if(session('status'))
        <div class="bg-green-600 mb-6 px-4 py-3 border border-green-500 rounded text-white">
            {{ session('status') }}
        </div>
        @endif

        <!-- Users Table -->
        <div class="bg-gray-900 shadow-lg rounded-lg overflow-hidden">
            <div class="flex justify-between items-center px-6 py-4 border-gray-700 border-b">
                <div>
                    <h2 class="font-semibold text-white text-lg">Users Directory</h2>
                    <p class="mt-1 text-gray-400 text-sm">Manage and view all registered users</p>
                </div>
                @auth
                @if(auth()->user()->isAdmin())
                <a href="{{ route('employees.index') }}"
                    class="inline-flex items-center bg-orange-600 hover:bg-orange-700 px-4 py-2 border border-transparent rounded-md font-semibold text-white text-xs uppercase tracking-widest transition duration-150 ease-in-out">
                    <svg class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Manage Employees
                </a>
                @endif
                @endauth
            </div>

            <div class="overflow-x-auto">
                <table class="divide-y divide-gray-700 min-w-full">
                    <thead class="bg-gray-800">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-medium text-gray-300 text-xs text-left uppercase tracking-wider">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium text-gray-300 text-xs text-left uppercase tracking-wider">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium text-gray-300 text-xs text-left uppercase tracking-wider">
                                Role
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium text-gray-300 text-xs text-left uppercase tracking-wider">
                                Joined
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-900 divide-y divide-gray-700">
                        @forelse($users as $user)
                        <tr class="hover:bg-gray-800 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <div class="flex justify-center items-center bg-orange-600 rounded-full w-10 h-10">
                                            <span class="font-medium text-white text-sm">
                                                {{ strtoupper(substr($user->first_name, 0, 1) . substr($user->last_name, 0, 1)) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="font-medium text-white text-sm">
                                            {{ $user->first_name }}
                                            @if($user->middle_name)
                                            {{ $user->middle_name }}
                                            @endif
                                            {{ $user->last_name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-gray-300 text-sm">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        @if($user->role === 'admin') bg-red-100 text-red-800
                                        @elseif($user->role === 'staff') bg-blue-100 text-blue-800
                                        @else bg-orange-100 text-orange-800
                                        @endif">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-300 text-sm whitespace-nowrap">
                                {{ $user->created_at->format('M d, Y') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="text-gray-400">
                                    <svg class="mx-auto mb-4 w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                    </svg>
                                    <h3 class="mb-2 font-medium text-lg">No users found</h3>
                                    <p class="text-sm">Get started by creating your first user account.</p>
                                    <a href="{{ route('register') }}" class="inline-block bg-orange-600 hover:bg-orange-700 mt-4 px-4 py-2 rounded-md font-medium text-white text-sm transition-colors">
                                        Create Account
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @auth
        <div class="mt-6 text-center">
            <p class="text-gray-400 text-sm">
                You are logged in as <span class="font-medium text-orange-400">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span>
                with <span class="font-medium text-orange-400">{{ ucfirst(auth()->user()->role) }}</span> privileges.
            </p>
        </div>
        @endauth
    </main>
</body>

</html>