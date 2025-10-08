<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index()
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Access denied. Admin access required.');
        }

        $employees = User::whereIn('role', [User::ROLE_ADMIN, User::ROLE_STAFF])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Access denied. Admin access required.');
        }

        return view('employees.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Access denied. Admin access required.');
        }

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,staff',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $employee = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'middle_name' => $request->middle_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('employees.index')
            ->with('status', 'Employee created successfully!');
    }

    public function edit(User $employee)
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Access denied. Admin access required.');
        }

        if ($employee->role === User::ROLE_CLIENT) {
            abort(404, 'Employee not found.');
        }

        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, User $employee)
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Access denied. Admin access required.');
        }

        if ($employee->role === User::ROLE_CLIENT) {
            abort(404, 'Employee not found.');
        }

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $employee->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,staff',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $updateData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'middle_name' => $request->middle_name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $employee->update($updateData);

        return redirect()->route('employees.index')
            ->with('status', 'Employee updated successfully!');
    }

    public function destroy(User $employee)
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Access denied. Admin access required.');
        }

        if ($employee->role === User::ROLE_CLIENT) {
            abort(404, 'Employee not found.');
        }

        if ($employee->id === Auth::id()) {
            return redirect()->route('employees.index')
                ->withErrors(['error' => 'You cannot delete your own account.']);
        }

        $employeeName = $employee->full_name;
        $employee->delete();

        return redirect()->route('employees.index')
            ->with('status', "Employee {$employeeName} deleted successfully!");
    }
}
