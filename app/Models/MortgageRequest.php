<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MortgageRequest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'house_id', 'duration', 'interest_id',
        'house_price', 'bank_name', 'interest', 'dp_total_amount',
        'dp_percantage', 'loan_total_amount', 'loan_interest_total_amount',
        'monthly_amount', 'status', 'documents',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function house()
    {
        return $this->belongsTo(House::class, 'house_id');
    }

    public function installments()
    {
        return $this->hasMany(Installment::class, 'mortgage_request_id');
    }
}
