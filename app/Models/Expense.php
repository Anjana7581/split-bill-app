<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'amount',
        'bill_id',
        'paid_by'
    ];

    public function bill(){
        return $this->belongsTo(Bill::class);
    }

    public function payer(){
        return $this->belongsTo(Friend::class,'paid_by');
    }

    public function shares(){
        return $this->belongsToMany(Friend::class,'expense_shares');
    }
}
