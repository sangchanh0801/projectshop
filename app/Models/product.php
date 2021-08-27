<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class product extends Model
{

    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'product_name',
        'product_slug',
        'product_desc',
        'product_content',
        'product_price',
        'product_cost',
        'product_size',
        'product_number',
        'product_sold',
        'product_status',
        'brand_id',
        'category_id',
    ];
    protected $primaryKey = 'product_id';
    public function category(){
        return $this->belongsTo('App\Models\category_product', 'category_id');
    }
    public function carts(){
        return $this->hasMany(Cart::class)->whereNotNull('order_id');
    }
}
