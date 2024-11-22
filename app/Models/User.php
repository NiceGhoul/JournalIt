<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'age',
        'gender',
        'profile_picture'
    ];

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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // One-to-Many: User has many Meditations
    public function meditations()
    {
        return $this->hasMany(Meditation::class);
    }

    // One-to-Many: User has many ToDoLists
    public function toDoLists()
    {
        return $this->hasMany(ToDoList::class);
    }

    // One-to-Many: User has many Analytics
    public function analytics()
    {
        return $this->hasMany(Analytic::class);
    }

    // Many-to-Many: User belongs to many Achievements
    public function achievements()
    {
        return $this->belongsToMany(Achievement::class, 'users_achievements')
                    ->withPivot('status')
                    ->withTimestamps();
    }

}
