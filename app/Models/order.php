<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'customer_id',
        'shipping_id',
        'order_status',
        'order_code',
        'order_date',
    ];
    protected $primaryKey = 'order_id';
}
