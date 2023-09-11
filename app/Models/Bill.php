<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $primaryKey = 'idBill';
    protected $table = 'bill';
    public $timestamps = false;
    protected $fillable = [
        'idBill',
        'idBookingTable',
        'idCart',
        'dateBill',
        'timeBill',
        'sumPrice',
        'discount',
        'discountGiftCode'
    ];
}
