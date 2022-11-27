<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryType extends Model
{
    use HasFactory;

    public function libraries()
    {
        return $this->hasMany(Library::class, 'type_id', 'id');
    }
}
