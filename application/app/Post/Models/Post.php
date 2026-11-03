<?php

namespace App\Post\Models;

use App\Admin\Models\Category;
use App\Blog\Models\Comment;
use App\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    
    protected $fillable = [
        'user_id',
        'title',
        'excerpt',
        'body',
        'category_id',
    ];

    protected static $factory = \App\Post\Database\Factories\PostFactory::class;

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}