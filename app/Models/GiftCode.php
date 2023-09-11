<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCode extends Model
{
    use HasFactory;
    protected $primaryKey = 'idGiftCode';
    protected $table = 'giftcode';
    public $timestamps = false;
    protected $fillable = [
        'idGiftCode',
        'nameGiftCode',
        'discountGiftCode',
        'isActive'
    ];
}
