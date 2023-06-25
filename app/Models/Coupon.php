<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Contracts\Validation\InvalidArgumentException;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException as GlobalInvalidArgumentException;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable=[
        'code',
        'type',
        'value',
        'status',
    ];

   
    public function discount($subtotal)
    {
        if (!is_numeric($subtotal)) {
            return 0; // Trả về 0 nếu subtotal không phải là số
        }
    
        if ($this->type === "fixed") {
            return $this->value;
        } elseif ($this->type === "percent") {
            return ($this->value / 100) * $subtotal;
        } else {
            return 0;
        }
    }
}
