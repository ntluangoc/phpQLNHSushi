<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingFood extends Model
{
    use HasFactory;
    protected $primaryKey = 'idBookingFood';
    protected $table = 'bookingfood';
    public $timestamps = false;
    protected $fillable = [
        'idBookingFood',
        'idBookingTable',
        'idFood',
        'amountBF',
        'priceBF'
    ];
}
