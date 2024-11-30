<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analytic extends Model
{

    use HasFactory;
   
    // protected $fillable = [
    //     'user_id',
    //     'type',
    // ];
   
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function meditations()
    {
        return $this->hasMany(Meditation::class);
    }

    public function toDoLists()
    {
        return $this->hasMany(ToDoList::class);
    }
}
