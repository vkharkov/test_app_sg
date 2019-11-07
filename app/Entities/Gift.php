<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{

    protected $fillable = [
        'name',
        'description',
        'quatity',
        'available'
    ];

    protected $casts = [
        'available' => 'boolean',
    ];

}
