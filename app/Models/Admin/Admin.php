<?php

namespace App\Models\Admin;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'role_id',
        'first_name',
        'last_name',
        'title',
        'email',
        'phone',
        'password',
        'origional_password',
        'status',
        'dob',
        'profile',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function getNameAttribute($value)
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }
}