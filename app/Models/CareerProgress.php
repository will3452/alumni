<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerProgress extends Model
{
    use HasFactory;

    // {{-- year, type (career, academic), company, school, job, level,  --}}
    protected $fillable = [
        'year',
        'type',
        'company',
        'school',
        'job',
        'level',
        'salary', 
        'user_id', 
    ];

    public function user () {
        return $this->belongsTo(User::class, 'user_id'); 
    }

}
