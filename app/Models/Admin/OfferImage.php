<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferImage extends Model
{
    use HasFactory;

    protected $fillable = [
      'offer_id',
      'file_type',
      'file_name',
  ];
    public function offer()
    {
        return $this->belongsTo('App\Models\Admin\Offer');
    }
}
