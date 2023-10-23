<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'approved_at',
        'amount',
        'receipt',
        'year_donated',
        'mop',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
