<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'file',
        'is_featured',
        'donation_type',
        'status',

    ];

    function donationAmmount()
    {
        return DonationReceipt::where('status', 1)->where('donation_id', $this->id)->sum('amount');
    }
}
