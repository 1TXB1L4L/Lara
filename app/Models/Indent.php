<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Medicine;
use App\Models\User;

class Indent extends Model
{
    use HasFactory;

    // Define the table name (optional, Laravel auto-detects plural names)
    protected $table = 'indents';

    protected $fillable = [
        'medicine_id',
        'medicine_name',
        'generic_name',
        'quantity',
        'indent_date',
        'indent_status',
        'notes',
        'user_id',
        'is_returned',
        'returned_reason',
    ];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}


