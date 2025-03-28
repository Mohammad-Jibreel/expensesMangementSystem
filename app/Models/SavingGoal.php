<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SavingGoal extends Model
{
    use HasFactory;

    protected $fillable = [
        'goal_name', 'goal_amount', 'monthly_savings', 'saved_amount', 'remaining_months', 'budget_id', 'user_id'
    ];

    // Relationship with User (each goal belongs to a user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Budget (each goal belongs to a budget)
    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }
}
