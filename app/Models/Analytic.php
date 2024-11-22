<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analytic extends Model
{
    /** @use HasFactory<\Database\Factories\AnalyticFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id'
    ];
    // Many-to-One: Analytics belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // One-to-One: Analytics has one Meditation
    public function meditation()
    {
        return $this->hasOne(Meditation::class);
    }

    // One-to-One: Analytics has one ToDoList
    public function toDoList()
    {
        return $this->hasOne(ToDoList::class);
    }
}
