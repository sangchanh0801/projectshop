<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'product_comment',
        'product_comment_status',

    ];
    protected $primaryKey = 'id';
}
