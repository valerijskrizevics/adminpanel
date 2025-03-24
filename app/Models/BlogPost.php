<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'title',
        'short_description',
        'text',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
