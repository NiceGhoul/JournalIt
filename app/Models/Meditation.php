<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meditation extends Model
{
    /** @use HasFactory<\Database\Factories\MeditationFactory> */
    use HasFactory;

    // protected $fillable = [
    //     'user_id',
    //     'name',
    //     'date_added',
    //     'status',
    //     'logo',
    //     'time',
    //     'analytic_id'
    // ];

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
