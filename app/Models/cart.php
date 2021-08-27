<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'carts';
    protected $fillable = [
        'user_id',
        'product_id',
        'order_id',
        'product_price',
        'product_qty',
        'product_amount',

    ];
    protected $primaryKey = 'id';
    public function product(){
        return $this->belongsTo(product::class, 'product_id');
    }

}
