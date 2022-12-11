<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    use HasFactory;
    protected $guard = 'admin';


    public function category()
    {
        return $this->belongsTo('App\Models\Admin\MagazineCategoy');
    }
}
