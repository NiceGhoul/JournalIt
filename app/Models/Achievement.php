<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    /** @use HasFactory<\Database\Factories\AchievementFactory> */
    use HasFactory;

    // protected $fillable = [
    //     'title',
    //     'description',
    //     'logo',
    // ];

    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_achievements')
                    ->withPivot('status')
                    ->withTimestamps();
    }
}
