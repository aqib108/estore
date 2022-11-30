<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table='classes';
    use HasFactory;
    protected $fillable = [
        'title',
        'course_id',
        'content',
        'status',
        'file',
        'url'
    ];
}
