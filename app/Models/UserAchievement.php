<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserAchievement extends Pivot
{
    
    protected $table = 'users_achievements';

    protected $fillable = [
        'user_id',
        'achievement_id',
        'status',
    ];
}
