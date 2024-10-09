<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine_log extends Model
{
    use HasFactory;

    protected $table = 'medicine_logs';

    protected $fillable = [
        'log_type',
        'medicine_id',
        'quantity',
        'date',
        'notes',
        'ref_id',
    ];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }

    public function ref()
    {
        return $this->belongsTo(Indent::class, 'ref_id');
    }
}
