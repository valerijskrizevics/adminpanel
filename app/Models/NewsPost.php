<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsPost extends Model
{
    use HasFactory;

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'title',
        'short_description',
        'text',
    ];

    // You can also add validation rules if needed
    public static $rules = [
        'title' => 'required|max:100',
        'short_description' => 'required|max:255',
        'text' => 'nullable',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

