<?php

namespace App\Models\ContactForm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactRecord extends Model
{
    use HasFactory;
    protected $table='contact_us';
    protected $fillable = [
        'email',
        'description',
    ];
}
