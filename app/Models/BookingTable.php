<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingTable extends Model
{
    use HasFactory;
    protected $primaryKey = 'idBookingTable';
    protected $table = 'bookingtable';
    public $timestamps = false;
    protected $fillable = [
        'idBookingTable',
        'idUser',
        'idTable',
        'amountBT',
        'dateBT',
        'timeBT',
        'noteBT',
        'isCheckin'
    ];
    protected $casts = [
        'dateBT' => 'date',
    ];
}
