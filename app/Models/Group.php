<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;
    protected $fillable = ['group_name', 'owner_id'];

    public function members()
    {
        return $this->hasMany(GroupMember::class, 'group_id');
    }

    public function expenses()
    {
        return $this->hasMany(GroupExpense::class, 'group_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
