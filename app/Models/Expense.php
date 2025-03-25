<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'description',
        'category_id',
        'amount',
        'receipt_image',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */


    protected $casts = [
        'submitted_at' => 'datetime',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime'
    ];

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'category_id');
    }

    public function scopeIsPending()
    {
        return $this->where('status', 'pending');
    }

    public function scopeIsApproved()
    {
        return $this->where('status', 'approved');
    }

    public function scopeIsRejected()
    {
        return $this->where('status', 'rejected');
    }
}
