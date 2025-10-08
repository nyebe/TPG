@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center px-4 sm:px-6 lg:px-8 py-12 min-h-screen">
    <div class="space-y-8 bg-white shadow-lg p-8 rounded-lg w-full max-w-md">
        <div>
            <h2 class="mt-6 font-extrabold text-gray-900 text-3xl text-center">
                Sign in to your account
            </h2>
            <p class="mt-2 text-gray-600 text-sm text-center">
                Or
                <a href="{{ route('register') }}" class="font-medium text-orange-600 hover:text-orange-500">
                    create a new account
                </a>
            </p>
        </div>
        <form class="space-y-6 mt-8" method="POST" action="{{ url('/login') }}">
            @csrf
            <div class="-space-y-px shadow-sm rounded-md">
                <div>
                    <label for="email" class="sr-only">Email address</label>
                    <input id="email" name="email" type="email" autocomplete="email" required
                        class="block focus:z-10 relative px-3 py-2 border border-gray-300 focus:border-orange-500 rounded-none rounded-t-md focus:outline-none focus:ring-orange-500 w-full text-gray-900 sm:text-sm appearance-none placeholder-gray-500"
                        placeholder="Email address" value="{{ old('email') }}">
                </div>
                <div>
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                        class="block focus:z-10 relative px-3 py-2 border border-gray-300 focus:border-orange-500 rounded-none rounded-b-md focus:outline-none focus:ring-orange-500 w-full text-gray-900 sm:text-sm appearance-none placeholder-gray-500"
                        placeholder="Password">
                </div>
            </div>

            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox"
                        class="border-gray-300 rounded focus:ring-orange-500 w-4 h-4 text-orange-600">
                    <label for="remember" class="block ml-2 text-gray-900 text-sm">
                        Remember me
                    </label>
                </div>

                <div class="text-sm">
                    <a href="#" class="font-medium text-orange-600 hover:text-orange-500">
                        Forgot your password?
                    </a>
                </div>
            </div>

            <div>
                <button type="submit"
                    class="group relative flex justify-center bg-orange-600 hover:bg-orange-700 px-4 py-2 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 w-full font-medium text-white text-sm">
                    <span class="left-0 absolute inset-y-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-orange-500 group-hover:text-orange-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    Sign in
                </button>
            </div>
        </form>
    </div>
</div>
@endsection