<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug', 'title', 'excerpt', 'content', 'image', 'author', 'category', 'published_at'
    ];
    
    protected $casts = [
        'published_at' => 'date',
    ];
}
