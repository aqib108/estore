<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MagazineCategory extends Model
{
    use HasFactory;
    protected $guard = 'admin';
    protected $fillable = [
        'name_english',
        'name_urdu',
        'name_arabic',
        'status'

    ];

    public function magzines()
    {
        return $this->hasMany(Magazine::class);
    }
}
