<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        // Create test users
        $this->admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'middle_name' => 'Test',
            'email' => 'admin@test.com',
            'password' => Hash::make('password123'),
            'role' => User::ROLE_ADMIN,
        ]);

        $this->staff = User::create([
            'first_name' => 'Staff',
            'last_name' => 'User',
            'middle_name' => null,
            'email' => 'staff@test.com',
            'password' => Hash::make('password123'),
            'role' => User::ROLE_STAFF,
        ]);

        $this->client = User::create([
            'first_name' => 'Client',
            'last_name' => 'User',
            'middle_name' => null,
            'email' => 'client@test.com',
            'password' => Hash::make('password123'),
            'role' => User::ROLE_CLIENT,
        ]);
    }

    public function test_admin_can_view_employees_index()
    {
        $response = $this->actingAs($this->admin)->get('/employees');

        $response->assertStatus(200);
        $response->assertViewIs('employees.index');
        $response->assertViewHas('employees');
        $response->assertSee('Employee Management');
        $response->assertSee($this->staff->full_name);
        $response->assertDontSee($this->client->full_name); // Clients should not appear
    }

    public function test_non_admin_cannot_view_employees_index()
    {
        // Test staff user
        $response = $this->actingAs($this->staff)->get('/employees');
        $response->assertStatus(403);

        // Test client user
        $response = $this->actingAs($this->client)->get('/employees');
        $response->assertStatus(403);

        // Test unauthenticated user
        $response = $this->get('/employees');
        $response->assertStatus(403);
    }

    public function test_admin_can_view_create_employee_form()
    {
        $response = $this->actingAs($this->admin)->get('/employees/create');

        $response->assertStatus(200);
        $response->assertViewIs('employees.create');
        $response->assertSee('Add New Employee');
        $response->assertSee('First Name');
        $response->assertSee('Role');
    }

    public function test_non_admin_cannot_view_create_employee_form()
    {
        $response = $this->actingAs($this->staff)->get('/employees/create');
        $response->assertStatus(403);

        $response = $this->actingAs($this->client)->get('/employees/create');
        $response->assertStatus(403);
    }

    public function test_admin_can_create_employee()
    {
        $employeeData = [
            'first_name' => 'New',
            'last_name' => 'Employee',
            'middle_name' => 'Test',
            'email' => 'new.employee@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'staff',
        ];

        $response = $this->actingAs($this->admin)->post('/employees', $employeeData);

        $response->assertRedirect('/employees');
        $response->assertSessionHas('status', 'Employee created successfully!');

        $this->assertDatabaseHas('users', [
            'first_name' => 'New',
            'last_name' => 'Employee',
            'middle_name' => 'Test',
            'email' => 'new.employee@test.com',
            'role' => 'staff',
        ]);

        // Verify password is hashed
        $employee = User::where('email', 'new.employee@test.com')->first();
        $this->assertTrue(Hash::check('password123', $employee->password));
    }

    public function test_non_admin_cannot_create_employee()
    {
        $employeeData = [
            'first_name' => 'New',
            'last_name' => 'Employee',
            'email' => 'new.employee@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'staff',
        ];

        $response = $this->actingAs($this->staff)->post('/employees', $employeeData);
        $response->assertStatus(403);

        $response = $this->actingAs($this->client)->post('/employees', $employeeData);
        $response->assertStatus(403);
    }

    public function test_employee_creation_validates_required_fields()
    {
        $response = $this->actingAs($this->admin)->post('/employees', []);

        $response->assertSessionHasErrors(['first_name', 'last_name', 'email', 'password', 'role']);
    }

    public function test_employee_creation_validates_unique_email()
    {
        $employeeData = [
            'first_name' => 'New',
            'last_name' => 'Employee',
            'email' => $this->staff->email, // Use existing email
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'staff',
        ];

        $response = $this->actingAs($this->admin)->post('/employees', $employeeData);

        $response->assertSessionHasErrors(['email']);
    }

    public function test_employee_creation_validates_password_confirmation()
    {
        $employeeData = [
            'first_name' => 'New',
            'last_name' => 'Employee',
            'email' => 'new.employee@test.com',
            'password' => 'password123',
            'password_confirmation' => 'differentpassword',
            'role' => 'staff',
        ];

        $response = $this->actingAs($this->admin)->post('/employees', $employeeData);

        $response->assertSessionHasErrors(['password']);
    }

    public function test_admin_can_view_edit_employee_form()
    {
        $response = $this->actingAs($this->admin)->get("/employees/{$this->staff->id}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('employees.edit');
        $response->assertViewHas('employee', $this->staff);
        $response->assertSee('Edit Employee');
        $response->assertSee($this->staff->first_name);
    }

    public function test_admin_cannot_edit_client_as_employee()
    {
        $response = $this->actingAs($this->admin)->get("/employees/{$this->client->id}/edit");

        $response->assertStatus(404);
    }

    public function test_admin_can_update_employee()
    {
        $updateData = [
            'first_name' => 'Updated',
            'last_name' => 'Staff',
            'middle_name' => 'Middle',
            'email' => 'updated.staff@test.com',
            'role' => 'admin',
        ];

        $response = $this->actingAs($this->admin)->put("/employees/{$this->staff->id}", $updateData);

        $response->assertRedirect('/employees');
        $response->assertSessionHas('status', 'Employee updated successfully!');

        $this->assertDatabaseHas('users', [
            'id' => $this->staff->id,
            'first_name' => 'Updated',
            'last_name' => 'Staff',
            'middle_name' => 'Middle',
            'email' => 'updated.staff@test.com',
            'role' => 'admin',
        ]);
    }

    public function test_admin_can_update_employee_password()
    {
        $updateData = [
            'first_name' => $this->staff->first_name,
            'last_name' => $this->staff->last_name,
            'email' => $this->staff->email,
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
            'role' => $this->staff->role,
        ];

        $response = $this->actingAs($this->admin)->put("/employees/{$this->staff->id}", $updateData);

        $response->assertRedirect('/employees');

        // Verify password was updated
        $updatedEmployee = User::find($this->staff->id);
        $this->assertTrue(Hash::check('newpassword123', $updatedEmployee->password));
    }

    public function test_admin_can_update_employee_without_changing_password()
    {
        $originalPassword = $this->staff->password;

        $updateData = [
            'first_name' => 'Updated',
            'last_name' => $this->staff->last_name,
            'email' => $this->staff->email,
            'role' => $this->staff->role,
        ];

        $response = $this->actingAs($this->admin)->put("/employees/{$this->staff->id}", $updateData);

        $response->assertRedirect('/employees');

        // Verify password remained the same
        $updatedEmployee = User::find($this->staff->id);
        $this->assertEquals($originalPassword, $updatedEmployee->password);
    }

    public function test_admin_can_delete_employee()
    {
        $employeeToDelete = User::create([
            'first_name' => 'Delete',
            'last_name' => 'Me',
            'email' => 'delete@test.com',
            'password' => Hash::make('password123'),
            'role' => User::ROLE_STAFF,
        ]);

        $response = $this->actingAs($this->admin)->delete("/employees/{$employeeToDelete->id}");

        $response->assertRedirect('/employees');
        $response->assertSessionHas('status');

        $this->assertDatabaseMissing('users', [
            'id' => $employeeToDelete->id,
        ]);
    }

    public function test_admin_cannot_delete_themselves()
    {
        $response = $this->actingAs($this->admin)->delete("/employees/{$this->admin->id}");

        $response->assertRedirect('/employees');
        $response->assertSessionHasErrors(['error']);

        $this->assertDatabaseHas('users', [
            'id' => $this->admin->id,
        ]);
    }

    public function test_admin_cannot_delete_client_through_employee_management()
    {
        $response = $this->actingAs($this->admin)->delete("/employees/{$this->client->id}");

        $response->assertStatus(404);

        $this->assertDatabaseHas('users', [
            'id' => $this->client->id,
        ]);
    }

    public function test_non_admin_cannot_update_employee()
    {
        $updateData = [
            'first_name' => 'Updated',
            'last_name' => 'Staff',
            'email' => 'updated@test.com',
            'role' => 'admin',
        ];

        $response = $this->actingAs($this->staff)->put("/employees/{$this->staff->id}", $updateData);
        $response->assertStatus(403);

        $response = $this->actingAs($this->client)->put("/employees/{$this->staff->id}", $updateData);
        $response->assertStatus(403);
    }

    public function test_non_admin_cannot_delete_employee()
    {
        $response = $this->actingAs($this->staff)->delete("/employees/{$this->staff->id}");
        $response->assertStatus(403);

        $response = $this->actingAs($this->client)->delete("/employees/{$this->staff->id}");
        $response->assertStatus(403);
    }

    public function test_employee_update_validates_unique_email()
    {
        $updateData = [
            'first_name' => $this->staff->first_name,
            'last_name' => $this->staff->last_name,
            'email' => $this->admin->email, // Use existing email
            'role' => $this->staff->role,
        ];

        $response = $this->actingAs($this->admin)->put("/employees/{$this->staff->id}", $updateData);

        $response->assertSessionHasErrors(['email']);
    }

    public function test_employee_management_only_shows_admin_and_staff()
    {
        $response = $this->actingAs($this->admin)->get('/employees');

        $response->assertStatus(200);

        // Should see admin and staff
        $response->assertSee($this->admin->first_name);
        $response->assertSee($this->admin->last_name);
        $response->assertSee($this->staff->first_name);
        $response->assertSee($this->staff->last_name);

        // Should not see client
        $response->assertDontSee($this->client->first_name . ' ' . $this->client->last_name);
    }
}
