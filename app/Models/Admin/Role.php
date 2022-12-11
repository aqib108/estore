<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 'right_ids', 'status'
    ];

    public function admins()
    {
        return $this->hasMany('App\Models\Admin\Admin');
    }
}
