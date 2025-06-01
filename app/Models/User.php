<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// Laravel Sanctum trait is missing - uncomment after running: composer require laravel/sanctum
// use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // Remove or comment out the HasApiTokens trait until Sanctum is installed
    // use HasApiTokens, HasFactory, Notifiable;
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role', // Add role to fillable fields
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
    ];

    /**
     * Check if the user is an admin.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    /**
     * Check if user has the given role
     *
     * @param string $role
     * @return bool
     */
    public function hasRole($role)
    {
        // If using is_admin column for admin role
        if ($role === 'admin') {
            return $this->isAdmin();
        }
        
        // If using a role column
        if (isset($this->attributes['role'])) {
            return $this->role === $role;
        }
        
        return false;
    }
}
