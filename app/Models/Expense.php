<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $primaryKey = 'expenseID';
    protected $fillable = ['expenseID','userID', 'amount', 'date', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

}
