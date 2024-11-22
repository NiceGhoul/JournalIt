<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    /** @use HasFactory<\Database\Factories\AchievementFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'logo',
    ];
    // Many-to-Many: Achievement belongs to many Users
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_achievements')
                    ->withPivot('status')
                    ->withTimestamps();
    }
}
