<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category_post extends Model
{
    use HasFactory;
    protected $table = 'category_posts';
    protected $fillable = [
        'category_post_name',
        'category_post_desc',

    ];
    protected $primaryKey = 'category_post_id';
}
