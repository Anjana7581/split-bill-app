<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Friend extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'email',
        'bill_id'
    ];

    public function bill(){
        return $this->belongsTo(Bill::class);
    }

    public function paidExpenses(){
        return $this->hasMany(Expense::class,'paid_by');
    }

    public function sharedExpenses(){
        return $this->belongsToMany(Expense::class,'expense_shares');
    }
}
