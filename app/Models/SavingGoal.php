<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavingGoal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'target_amount',
        'saved_amount',
        'duration',
        'start_date',
        'end_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
