<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meditation extends Model
{
    /** @use HasFactory<\Database\Factories\MeditationFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'date_added',
        'status',
        'logo',
        'analytic_id'
    ];
    // Many-to-One: Meditation belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Optional One-to-One: Meditation belongs to an Analytics
    public function analytics()
    {
        return $this->belongsTo(Analytic::class);
    }

}
