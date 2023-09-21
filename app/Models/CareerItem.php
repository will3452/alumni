<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'career_id',
        'description',
        'title',
        'level',
    ];

    public function career()
    {
        return $this->belongsTo(Career::class);
    }
}
