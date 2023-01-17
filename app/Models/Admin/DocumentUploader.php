<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class DocumentUploader extends Model
{
    use HasFactory;
    protected $table='document_uploader';
    protected $fillable = [
        'name',
        'document_id',
        'status',
        'path'
    ];
    
}
