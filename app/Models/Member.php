<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'practice_no',
        'last_name',
        'first_name',
        'chapter',
        'email',
        'category',
        'status',
        'passport',
    ];
}
