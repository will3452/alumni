<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user',
        'course',
        'school_year',
        'image',
        'type',
        'descriptions',
        'skills',
    ];

    const TYPE_STUDENT = 'Student';
    const TYPE_ALUMNI = 'Alumni';
    const TYPE_COORDINATOR = 'Coordinator';
    const TYPE_ADMIN = 'Administrator';

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

    public function donations()
    {
        return $this->hasMany(Donation::class, 'user_id');
    }
}
