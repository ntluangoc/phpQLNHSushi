<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasFactory;
    protected $primaryKey = 'idUser';
    protected $table = 'user';
    public $timestamps = false;
    protected $fillable = [
        'idUser',
        'nameUser',
        'birthday',
        'phone',
        'address',
        'email',
        'avatar'
    ];
    protected $casts = [
        'birthday' => 'datetime',
    ];
}
