<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $with = [
        'doneItems',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
    ];

    public function objectives()
    {
        return $this->hasMany(Objective::class, 'user_id');
    }

    public function doneItems()
    {
        return $this->belongsToMany(CareerItem::class, 'dones', 'user_id', 'item_id');
    }

    const TYPE_ADMIN = "Administrator";
    const TYPE_STUDENT = "Student";
    const TYPE_ALUMNI = "Alumni";
    const TYPE_PARTNER = "Partner";
    const TYPE_COORDINATOR = "Coordinator";

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
