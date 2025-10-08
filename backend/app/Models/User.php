<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $last_name
 * @property string $role
 * @property string $email
 * @property string $password
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'role',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attributes that should be appended to the model when serializing.
     * `full_name` is useful for responses and auth payloads.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'full_name',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    // Role constants
    public const ROLE_ADMIN = 'admin';
    public const ROLE_CLIENT = 'client';
    public const ROLE_STAFF = 'staff';

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /* ---------------------------------------------------------------------
     |  Helpers / Accessors (auth-friendly)
     | ---------------------------------------------------------------------
     | Small, focused helpers to make the User model handy for authentication
     | and authorization checks. Keep these lightweight; business logic
     | should live in Services when it grows.
     */

    /**
     * Return the user's full name (First Middle Last). Middle name is
     * omitted if null.
     */
    public function getFullNameAttribute(): string
    {
        $parts = array_filter([
            $this->first_name ?? '',
            $this->middle_name ?? '',
            $this->last_name ?? '',
        ], fn($p) => trim($p) !== '');

        return implode(' ', $parts);
    }

    /**
     * Check role helpers
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isClient(): bool
    {
        return $this->role === self::ROLE_CLIENT;
    }

    public function isStaff(): bool
    {
        return $this->role === self::ROLE_STAFF;
    }

    /**
     * Scope to filter users by role: User::role('admin')->get()
     *
     * @param  Builder  $query
     */
    public function scopeRole(Builder $query, string $role): Builder
    {
        return $query->where('role', $role);
    }
}
