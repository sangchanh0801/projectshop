<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    use HasFactory;
    protected $fillable = [
        'tag_name',
        'tag_slug',
        'tag_status',
    ];
    protected $primaryKey = 'tag_id';
}
