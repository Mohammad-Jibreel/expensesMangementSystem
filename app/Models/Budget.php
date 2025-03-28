<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'salary', 'total_expenses', 'remaining_balance', 'year', 'month'];
    public static function boot()
    {
        parent::boot();

        static::saving(function ($budget) {
            $budget->remaining_balance = $budget->salary - $budget->total_expenses;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
