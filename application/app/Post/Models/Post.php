<?php

namespace App\Post\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    
    protected $fillable = [
        'user_id',
        'title',
        'excerpt',
        'body',
        'categories',
    ];
}