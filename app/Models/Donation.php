<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'description',
        'mop',
        'pop',
        'reference_no',
        'amount',
    ];

    const STATUS_DRAFT = "DRAFT";
    const STATUS_APPROVED = "APPROVED";
    const STATUS_PENDING = "PENDING";
    const STATUS_REJECTED = "REJECTED";

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
