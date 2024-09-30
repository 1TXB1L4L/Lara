<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indent extends Model
{
    use HasFactory;

    // Define the table if it's not plural (optional, if the table is 'indents', Laravel will detect it automatically)
    protected $table = 'indents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'medicine_id',
        'medicine_name',
        'generic_name',
        'quantity',
        'indent_quantity',
        'indent_amount',
        'indent_date',
        'indent_status',
        'indent_remarks',
        'previous_quantity',
    ];

    /**
     * Get the medicine related to this indent.
     */
    public function medicine()
    {
        return $this->belongsTo(Medicine::class); // Assuming you have a Medicine model
    }

    /**
     * Scope a query to only include pending indents.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->where('indent_status', 'pending');
    }

    /**
     * Scope a query to only include approved indents.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeApproved($query)
    {
        return $query->where('indent_status', 'approved');
    }

    /**
     * Scope a query to only include rejected indents.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRejected($query)
    {
        return $query->where('indent_status', 'rejected');
    }

    /**
     * Update indent status.
     *
     * @param string $status
     * @return void
     */
    public function updateStatus($status)
    {
        if (in_array($status, ['pending', 'approved', 'rejected'])) {
            $this->indent_status = $status;
            $this->save();
        }
    }
}
