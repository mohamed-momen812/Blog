<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [ // columns can be implemnted
        "title",
        'description',
        'user_id',
        // if insert new not existing column it will be ignored
    ];

    public function user() { // for populating, not calling as a function
        return $this->belongsTo(related: User::class, foreignKey:'user_id');
    }
}
