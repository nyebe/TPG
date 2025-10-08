@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="font-bold text-white text-2xl">Add New Employee</h1>
    <p class="mt-1 text-gray-400">Create a new admin or staff member</p>
</div>

<div class="bg-gray-900 shadow-lg rounded-lg overflow-hidden">
    <div class="px-6 py-4 border-gray-700 border-b">
        <h2 class="font-semibold text-white text-lg">Employee Information</h2>
    </div>

    <form method="POST" action="{{ route('employees.store') }}" class="px-6 py-6">
        @csrf

        <div class="gap-6 grid grid-cols-1 sm:grid-cols-2">
            <!-- First Name -->
            <div>
                <label for="first_name" class="block font-medium text-gray-300 text-sm">First Name</label>
                <input type="text"
                    id="first_name"
                    name="first_name"
                    value="{{ old('first_name') }}"
                    class="mt-1 block w-full bg-gray-800 border border-gray-700 rounded-md px-3 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('first_name') border-red-500 @enderror"
                    placeholder="Enter first name"
                    required>
                @error('first_name')
                <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Last Name -->
            <div>
                <label for="last_name" class="block font-medium text-gray-300 text-sm">Last Name</label>
                <input type="text"
                    id="last_name"
                    name="last_name"
                    value="{{ old('last_name') }}"
                    class="mt-1 block w-full bg-gray-800 border border-gray-700 rounded-md px-3 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('last_name') border-red-500 @enderror"
                    placeholder="Enter last name"
                    required>
                @error('last_name')
                <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Middle Name -->
            <div class="sm:col-span-2">
                <label for="middle_name" class="block font-medium text-gray-300 text-sm">Middle Name (Optional)</label>
                <input type="text"
                    id="middle_name"
                    name="middle_name"
                    value="{{ old('middle_name') }}"
                    class="mt-1 block w-full bg-gray-800 border border-gray-700 rounded-md px-3 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('middle_name') border-red-500 @enderror"
                    placeholder="Enter middle name (optional)">
                @error('middle_name')
                <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="sm:col-span-2">
                <label for="email" class="block font-medium text-gray-300 text-sm">Email Address</label>
                <input type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="mt-1 block w-full bg-gray-800 border border-gray-700 rounded-md px-3 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('email') border-red-500 @enderror"
                    placeholder="Enter email address"
                    required>
                @error('email')
                <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role -->
            <div class="sm:col-span-2">
                <label for="role" class="block font-medium text-gray-300 text-sm">Role</label>
                <select id="role"
                    name="role"
                    class="mt-1 block w-full bg-gray-800 border border-gray-700 rounded-md px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('role') border-red-500 @enderror"
                    required>
                    <option value="">Select a role</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrator</option>
                    <option value="staff" {{ old('role') === 'staff' ? 'selected' : '' }}>Staff Member</option>
                </select>
                @error('role')
                <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block font-medium text-gray-300 text-sm">Password</label>
                <input type="password"
                    id="password"
                    name="password"
                    class="mt-1 block w-full bg-gray-800 border border-gray-700 rounded-md px-3 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('password') border-red-500 @enderror"
                    placeholder="Enter password (min. 8 characters)"
                    required>
                @error('password')
                <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block font-medium text-gray-300 text-sm">Confirm Password</label>
                <input type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    class="block bg-gray-800 mt-1 px-3 py-2 border border-gray-700 focus:border-orange-500 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 w-full text-white placeholder-gray-400"
                    placeholder="Confirm password"
                    required>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-end space-x-3 mt-6 pt-6 border-gray-700 border-t">
            <a href="{{ route('employees.index') }}"
                class="inline-flex items-center bg-gray-600 hover:bg-gray-700 px-4 py-2 border border-transparent rounded-md font-semibold text-white text-xs uppercase tracking-widest transition duration-150 ease-in-out">
                Cancel
            </a>
            <button type="submit"
                class="inline-flex items-center bg-orange-600 hover:bg-orange-700 px-4 py-2 border border-transparent rounded-md font-semibold text-white text-xs uppercase tracking-widest transition duration-150 ease-in-out">
                <svg class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Create Employee
            </button>
        </div>
    </form>
</div>
@endsection