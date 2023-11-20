<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'step_id',
        'file', 
        'status', 
    ]; 
    
    public function step () {
        return $this->belongsTo(Step::class, 'step_id'); 
    }

    public function user () {
        return $this->belongsTo(User::class, 'user_id'); 
    }
}
