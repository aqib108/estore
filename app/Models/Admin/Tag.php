<?php

namespace App\Models\Admin;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Tag extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'name',
        'status',
    ];

    function posts()
    {
        return $this->belongsToMany('App\Models\Admin\Tag');
    }

    function tagPosts()
    {
        return $this->belongsToMany('App\Models\Admin\Post');
    }
}