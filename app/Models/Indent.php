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

    // Status constants
    const STATUS_ACTIVE = 'Active';
    const STATUS_INACTIVE = 'Inactive';

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
        'batch_number',
        'expiry_date',
        'received',
        'user_id',
        'is_returned',
    ];

    /**
     * Get the medicine related to this indent.
     */
    public function medicine()
    {
        return $this->belongsTo(Medicine::class); // Assuming you have a Medicine model
    }

    /**
     * Get the user who created the indent.
     */
    public function user()
    {
        return $this->belongsTo(User::class); // Assuming you have a User model
    }

    /**
     * Scope a query to only include active indents.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('indent_status', self::STATUS_ACTIVE);
    }

    /**
     * Scope a query to only include inactive indents.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInactive($query)
    {
        return $query->where('indent_status', self::STATUS_INACTIVE);
    }

    /**
     * Update indent status.
     *
     * @param string $status
     * @return void
     */
    public function updateStatus($status)
    {
        if (in_array($status, [self::STATUS_ACTIVE, self::STATUS_INACTIVE])) {
            $this->indent_status = $status;
            $this->save();
        }
    }

    /**
     * Check if the indent has been received.
     *
     * @return bool
     */
    public function isReceived()
    {
        return $this->received;
    }

    /**
     * Mark the indent as received.
     */
    public function markAsReceived()
    {
        $this->received = true;
        $this->save();
    }

    /**
     * Check if the indent has been returned.
     *
     * @return bool
     */
    public function isReturned()
    {
        return $this->is_returned;
    }

    /**
     * Mark the indent as returned.
     */
    public function markAsReturned()
    {
        $this->is_returned = true;
        $this->save();
    }
}
