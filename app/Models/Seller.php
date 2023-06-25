<?php

namespace App\Models;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Seller extends Authenticatable
{
    use HasFactory,Notifiable;
    protected $guard= 'admins';
    protected $fillable = [
        'full_name',
        'username',
        'email',
        'email_verified_at',
        'password',
        'address',
        'photo',
        'phone',
        'is_verified',
        'status',
    ];
}
