<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'gallery_name',
        'product_id',
        'gallery_image',
    ];
    protected $primaryKey = 'gallery_id';
}
