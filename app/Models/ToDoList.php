<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDoList extends Model
{
    /** @use HasFactory<\Database\Factories\ToDoListFactory> */
    use HasFactory;
    
    // protected $fillable = [
    //     'name',
    //     'to_do_date',
    //     'logo',
    //     'target',
    //     'progress',
    //     'user_id',
    //     'date_added',
    //     'status',
    // ];

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
