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
