@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="font-bold text-white text-2xl">Employee Management</h1>
        <p class="mt-1 text-gray-400">Manage admin and staff members</p>
    </div>
    <a href="{{ route('employees.create') }}"
        class="inline-flex items-center bg-orange-600 hover:bg-orange-700 px-4 py-2 border border-transparent rounded-md font-semibold text-white text-xs uppercase tracking-widest transition duration-150 ease-in-out">
        <svg class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        Add Employee
    </a>
</div>

<div class="bg-gray-900 shadow-lg rounded-lg overflow-hidden">
    <div class="px-6 py-4 border-gray-700 border-b">
        <h2 class="font-semibold text-white text-lg">Employees</h2>
        <p class="mt-1 text-gray-400 text-sm">A list of all employees including their name, email, role and actions.</p>
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
                    <th scope="col" class="px-6 py-3 font-medium text-gray-300 text-xs text-left uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-gray-900 divide-y divide-gray-700">
                @forelse($employees as $employee)
                <tr class="hover:bg-gray-800 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-10 h-10">
                                <div class="flex justify-center items-center bg-orange-600 rounded-full w-10 h-10">
                                    <span class="font-medium text-white text-sm">
                                        {{ strtoupper(substr($employee->first_name, 0, 1) . substr($employee->last_name, 0, 1)) }}
                                    </span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="font-medium text-white text-sm">
                                    {{ $employee->first_name }}
                                    @if($employee->middle_name)
                                    {{ $employee->middle_name }}
                                    @endif
                                    {{ $employee->last_name }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-gray-300 text-sm">{{ $employee->email }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                @if($employee->role === 'admin') bg-red-100 text-red-800
                                @else bg-blue-100 text-blue-800
                                @endif">
                            {{ ucfirst($employee->role) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-300 text-sm whitespace-nowrap">
                        {{ $employee->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 text-sm whitespace-nowrap">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('employees.edit', $employee) }}"
                                class="inline-flex items-center bg-blue-600 hover:bg-blue-700 px-2.5 py-1.5 border border-transparent rounded font-medium text-white text-xs transition duration-150 ease-in-out">
                                <svg class="mr-1 w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </a>

                            @if($employee->id !== auth()->id())
                            <form method="POST" action="{{ route('employees.destroy', $employee) }}"
                                onsubmit="return confirm('Are you sure you want to delete {{ $employee->full_name }}? This action cannot be undone.')"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center bg-red-600 hover:bg-red-700 px-2.5 py-1.5 border border-transparent rounded font-medium text-white text-xs transition duration-150 ease-in-out">
                                    <svg class="mr-1 w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                            @else
                            <span class="inline-flex items-center bg-gray-600 px-2.5 py-1.5 border border-transparent rounded font-medium text-gray-400 text-xs">
                                <svg class="mr-1 w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Current User
                            </span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <div class="text-gray-400">
                            <svg class="mx-auto mb-4 w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <h3 class="mb-2 font-medium text-lg">No employees found</h3>
                            <p class="text-sm">Get started by creating your first employee.</p>
                            <a href="{{ route('employees.create') }}"
                                class="inline-block bg-orange-600 hover:bg-orange-700 mt-4 px-4 py-2 rounded-md font-medium text-white text-sm transition-colors">
                                Add Employee
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    <a href="{{ url('/') }}"
        class="inline-flex items-center bg-gray-600 hover:bg-gray-700 px-4 py-2 border border-transparent rounded-md font-semibold text-white text-xs uppercase tracking-widest transition duration-150 ease-in-out">
        <svg class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Back to Dashboard
    </a>
</div>
@endsection