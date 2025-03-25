<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_name',
    ];

    public function members()
    {
        return $this->belongsToMany(User::class, 'group_members');
    }

    public function expenses()
    {
        return $this->hasMany(GroupExpense::class);
    }

}
