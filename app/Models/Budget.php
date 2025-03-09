<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = ['userID', 'limit', 'startDate', 'endDate'];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }
}
