<?php

namespace App\Models\Admin;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PostCategory extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';
    protected $table = 'category_post';
    protected $fillable = [
        'post_id',
        'category_id',
    ];
}