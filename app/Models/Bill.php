<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function friends(){
        return $this->hasMany(Friend::class);
    }

    public function expenses(){
        return $this->hasMany(Expense::class);
    }
}
