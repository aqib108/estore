<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table='news';
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'status',
        'author_name',
        'location'
    ];
}
