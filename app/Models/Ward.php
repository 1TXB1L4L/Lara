<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    protected $table = 'wards';

    protected $fillable = [
        'ward_name',
        'ward_description',
        'ward_capacity',
        'ward_status',
    ];

    protected $casts = [
        'ward_capacity' => 'integer', // or 'float' if it should be a decimal
        'ward_status' => 'boolean',
    ];
}
