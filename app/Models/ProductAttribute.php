<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;
    
    protected $filable = [
        'product_id',
        'size',
        'original_price',
        'offer_price',
        'stock'
    ];
}
