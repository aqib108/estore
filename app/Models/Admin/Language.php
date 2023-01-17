<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Language extends Model
{
    protected $table='languages';
    use HasFactory;
    public static function all($columns = null)
    {
        $obj = DB::table('languages')->where('status',1)->get();
        return $obj;
    }
}
