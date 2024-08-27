<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Medicine extends Model
{
    use HasFactory;

    protected $table = 'medicines';

    protected $fillable = [
        'med_name',
        'med_description',
        'med_generic_name',
        'med_quantity',
        'med_price',
        'med_batch_no',
        'med_dosage',
        'med_strength',
        'med_route',
        'med_therapeutic_class',
        'med_notes',
        'med_expiry_date',
        'med_category',
        'med_manufacturer',
        'med_status',
        'med_image',
    ];

    protected $casts = [
        'med_expiry_date' => 'date',
    ];
}
