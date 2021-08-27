<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'post_title',
        'post_slug',
        'post_desc',
        'post_content',
        'post_author',
        'post_tag',
        'post_status',
        'post_image',
        'cate_post_id'

    ];
    protected $primaryKey = 'post_id';
    public function cate_post(){
        return $this->belongsTo('App\Models\category_post', 'category_post_id');
    }

}
