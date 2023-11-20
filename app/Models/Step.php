<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'requirements',
        'descriptions',
        'sq',
        'jobs', 
    ];
}
