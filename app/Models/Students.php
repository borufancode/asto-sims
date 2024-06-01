<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $table='students';
    protected $fillable=
    [
        'full_name',
        'gender',
        'age',
        'profile'
    ];
    use HasFactory;
}
