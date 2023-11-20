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
        'status', 
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

    public function goals () {
        return $this->belongsToMany(Course::class, 'user_courses', 'user_id', 'course_id'); 
    }

    public function isDone($stepId) {
        return DoneStep::whereUserId($this->id)->whereStepId($stepId)->exists(); 
    }

    public function userSteps() {
        return $this->hasMany(UserStep::class, 'user_id'); 
    }

    public function hasSubmittedRequirements($stepId) {
        return $this->userSteps()->whereStepId($stepId)->exists(); 
    }

    public function hasApprovedRequirements($stepId) {
        return $this->userSteps()->whereStepId($stepId)->whereStatus('APPROVED')->exists(); 
    }
}
