<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $fillable = [
        'course',
        'description',
    ];

    public function items()
    {
        return $this->hasMany(CareerItem::class, 'career_id');
    }
}
