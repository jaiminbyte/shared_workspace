<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = [
        'customer_id',
        'booking_date',
        'workspace_id',
        'payment',
        'amount',
        'state_of_booking',
        'start_time',
        'end_time'
    ];
}