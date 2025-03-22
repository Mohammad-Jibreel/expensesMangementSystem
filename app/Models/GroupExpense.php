<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupExpense extends Model
{
    use HasFactory;
    protected $fillable = ['group_id', 'user_id', 'amount', 'description'];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
