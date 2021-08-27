<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class category_product extends Model
{

    use HasFactory;

    protected $table = 'category_products';
    protected $fillable = [
        'category_name',
        'category_desc',
        'category_slug',
    ];

    protected $primaryKey = 'category_id';

    public function product(){
        return $this->hasMany('App\Models\product');
    }
}
