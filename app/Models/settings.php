<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class settings extends Model
{
    use HasFactory;
    protected $table = 'settings';
    protected $fillable = [
        'setting_phone',
        'setting_email',
        'setting_address',
        'setting_logo',
        'setting_desc',
    ];
    protected $primaryKey = 'setting_id';
}
