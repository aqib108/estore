<?php

namespace App\Models\Admin;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Page extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'admin_id',
        'title',
        'url',
        'short_description',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'in_header',
        'in_footer',
    ];
}