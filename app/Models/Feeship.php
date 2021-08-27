<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feeship extends Model
{
    use HasFactory;
    protected $table = 'feeships';
    protected $fillable = [
        'fee_matp',
        'fee_maqh',
        'fee_xaid',
        'fee_ship'
    ];
    protected $primaryKey = 'fee_id';

    public function city(){
        return $this->belongsTo('App\Models\City', 'fee_matp');
    }
    public function province(){
        return $this->belongsTo('App\Models\Province', 'fee_maqh');
    }
    public function ward(){
        return $this->belongsTo('App\Models\Wards', 'fee_xaid');
    }

}
