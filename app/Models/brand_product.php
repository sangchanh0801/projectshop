<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brand_product extends Model
{
    use HasFactory;
    protected $table = 'brand_products';
    protected $fillable = [
        'brand_name',
        'brand_desc',
        'brand_image',
        'brand_status'
    ];
    protected $primaryKey = 'brand_id';
}
