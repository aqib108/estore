<?php

namespace App\Models\Admin;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PostTag extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';
    protected $table = 'post_tag';
    protected $fillable = [
        'post_id',
        'tag_id',
    ];
}