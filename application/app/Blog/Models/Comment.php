<?php

namespace App\Blog\Models;

use App\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    
    protected $table = 'comments';
    
    protected $fillable = [
        'user_id',
        'post_id',
        'body',
    ];

    protected static $factory = \App\Blog\Database\Factories\CommentFactory::class;

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}