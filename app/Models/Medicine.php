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
        'name',
        'description',
        'generic_id',
        'quantity',
        'price',
        'batch_no',
        'dosage',
        'strength',
        'route',
        'notes',
        'expiry_date',
        'category',
        'manufacturer',
        'status',
        'image',
    ];

    protected $casts = [
        'expiry_date' => 'date',
    ];

    public function generic()
    {
        return $this->belongsTo(Generic::class);
    }
}
