<?php
// app/Models/PendingUser.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password', 'student_id', 'department', 'year_level', 'section'
    ];

    protected $hidden = [
        'password'
    ];
}
