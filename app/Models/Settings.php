<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{ 
    
    use HasFactory;

    protected $fillable =[
        'title',
        'meta_description',
        'meta_keywords',
        'logo',
        'favicon',
        'email',
        'phone',
        'address',
        'footer',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'google_url',
        'printerest',

    ];
}
