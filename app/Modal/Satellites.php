<?php

namespace App\Modal;

use Illuminate\Database\Eloquent\Model;

class Satellites extends Model
{
    protected $fillable = [
        'name',
        'distance',
        'message',
    ];
}
