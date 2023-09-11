<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartFood extends Model
{
    use HasFactory;
    protected $primaryKey = 'idCartFood';
    protected $table = 'cartfood';
    public $timestamps = false;
    protected $fillable = [
        'idCartFood',
        'idCart',
        'idFood',
        'amountCF',
        'datetimeCF',
        'priceCF',
        'isPay'
    ];
    protected $casts = [
        'datetimeCF' => 'datetime',
    ];
}
