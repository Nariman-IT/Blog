<?php

namespace App\Post\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'excerpt' => $this->excerpt,
            'body' => $this->body,
            'count' => $this->comments()->count(), 
            'categories' => $this->category->category,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}