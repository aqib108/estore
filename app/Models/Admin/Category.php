<?php

namespace App\Models\Admin;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Category extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'name',
        'url',
        'in_header',
        'in_footer',
        'position',
        'description',
        'image',
        'parent_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
    ];

    public function ProductCategory()
    {
        return $this->hasMany($this, 'parent_id');
    }

    public function rootCategories()
    {
        return $this->where('parent_id', null)->with('ProductCategory')->get();
    }

    public function subCategories()
    {
        return $this->where(['parent_id'=>$this->id,'in_header'=>1,'status'=>1])->get();
    }

     function categoryPosts()
    {
        return $this->belongsToMany('App\Models\Admin\Post');
    }
}