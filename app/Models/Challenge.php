<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Challenge extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'challenge_name', 'completed'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
