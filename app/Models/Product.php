<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'slug',
        'is_featured',
        'summary',
        'description',
        'additional_info',  
        'return_cancellation',
        'stock',
        'price',
        'offer_price',
        'discount',
        'condition',
        'status',
        'photo',
        'size_guide',
        'size',
        'brand_id',
        'cat_id',
        'child_cat_id',
        'user_id',
        'added_by'
    ];


    public function brand(){
        return $this->belongsTo('App\Models\Brand');
    }

    public  function rel_products(){
        return  $this->hasMany('App\Models\Product','cat_id','cat_id')->where('status','active')->limit(10);
    }

    public static function getProductByCart($id){
        return self::where('id',$id)->get()->toArray();
    }

    public function orders(){
       return $this->belongsToMany(Order::class,'product_orders')->withPivot('quantity');
      }
}
