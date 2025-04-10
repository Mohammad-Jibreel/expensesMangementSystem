<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SavingGoal extends Model
{
    use HasFactory;

    protected $fillable = [
        'goal_name',
        'goal_amount',
        'monthly_income',
        'saving_percentage',
        'monthly_savings',
        'remaining_months',
        'saved_amount',
        'budget_id',
        'user_id',
    ];


    // Relationship with User (each goal belongs to a user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }

}
