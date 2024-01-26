<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueBooking extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'location',
        'description',
        'phone'
    ];
}
