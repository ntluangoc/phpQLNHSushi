<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $primaryKey = 'idFood';
    protected $table = 'food';
    public $timestamps = false;
    protected $fillable = [
        'idFood',
        'nameFood',
        'priceFood',
        'typeFood',
        'forPerson',
        'amountFood',
        'imgFood',
        'isActive'
    ];
}
