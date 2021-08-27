<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class banner extends Model
{
    use HasFactory;
    protected $table = 'banners';
    protected $fillable = [
        'banner_name',
        'banner_slug',
        'banner_image',
        'banner_desc',
        'banner_status',
    ];
    protected $primaryKey = 'banner_id';
}
