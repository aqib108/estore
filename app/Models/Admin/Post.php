<?php

namespace App\Models\Admin;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Post extends Authenticatable
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
        'theme_image',
        'slider_post',
        'feature',
    ];

    function tags()
    {
        return $this->belongsToMany('App\Models\Admin\Tag');
    }
    function postCategories()
    {
        return $this->hasMany('App\Models\Admin\PostCategory');
    }
    function featureImage()
    {
        return $this->hasOne('App\Models\Admin\PostFeatureImage');
    }
    function themeImage()
    {
        return $this->hasOne('App\Models\Admin\PostThemeImage');
    }
    function author()
    {
        return $this->hasOne('App\Models\Admin\Admin','id','admin_id');
    }
}