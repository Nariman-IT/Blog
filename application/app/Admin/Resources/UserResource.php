<?php

namespace App\Admin\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'posts_count' => $this->posts()->count(),
            'author_assigned_at' => $this->author_assigned_at,
            'last_post_at' => $this->posts()->latest()->first()?->created_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
