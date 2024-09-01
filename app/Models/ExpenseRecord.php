<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseRecord extends Model
{
    use HasFactory;

    protected $table = 'expense_record';

    protected $fillable = ['expense_id', 'medicines_id', 'quantity'];

    public function expense(): BelongsTo
    {
        return $this->belongsTo(Expense::class);
    }

    public function medicines(): BelongsTo
    {
        return $this->belongsTo(Medicines::class);
    }

}
