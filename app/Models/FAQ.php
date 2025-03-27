<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FAQ extends Model
{
    protected $table = 'faqs';
    use HasFactory;
    protected $fillable = ['question', 'answer'];

}
