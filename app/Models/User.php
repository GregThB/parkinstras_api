<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'civility',
        'email',
        'password',
        'img'
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
    ];

    /**
     * Check if the user has a role
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role) 
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    /**
     * Check if the user has any role
     * @param array $role
     * @return bool
     */
    public function hasAnyRoles(array $roles) 
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function rates() {
        return $this->hasMany(Rate::class);
    }

    public function likes() {
        return $this->belongsToMany(Like::class);
    }
}
