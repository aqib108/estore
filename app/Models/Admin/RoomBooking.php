<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomBooking extends Model
{
    protected $table='room_booking';
    use HasFactory;
    protected $fillable = [
        'booking_no',
        'room_id',
        'customer_id',
        'expiry_at',
        'start_date',
        'end_date'
    ];
    public static $bookingNumberPrefix='BOOKING-NO-';
}
