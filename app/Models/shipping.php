<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shipping extends Model
{
    use HasFactory;
    protected $table = 'shippings';
    protected $fillable = [
        'shipping_fname',
        'shipping_lname',
        'shipping_email',
        'shipping_phone',
        'shipping_address',
        'shipping_city',
        'shipping_province',
        'shipping_wards',
        'shipping_method',
        'shipping_notes',

    ];
}
