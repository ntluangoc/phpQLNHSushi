<?php

namespace App\Models;



use Illuminate\Foundation\Auth\User as Authenticatable;
class Account extends Authenticatable
{
    protected $primaryKey = 'idAccount';
    protected $table = 'account';
    public $timestamps = false;
    protected $fillable = [
        'idAccount',
        'idUser',
        'username',
        'password',
        'role',
    ];
}
