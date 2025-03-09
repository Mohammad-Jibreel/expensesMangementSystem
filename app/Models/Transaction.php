<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['userID', 'transactionDate', 'amount', 'method'];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }
}
