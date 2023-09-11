<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $primaryKey = 'idCustomer';
    protected $table = 'customer';
    public $timestamps = false;
    protected $fillable = [
        'idCustomer',
        'idUser',
        'amountBooking',
        'discount'
    ];
}
