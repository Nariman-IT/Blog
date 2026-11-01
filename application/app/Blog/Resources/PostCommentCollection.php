<?php

namespace App\Blog\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCommentCollection extends ResourceCollection
{
    public $collects = PostCommentResource::class;

    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
            'meta' => [
                'per_page'    => $this->perPage(),
                'next_cursor' => $this->nextCursor()?->encode(),
                'prev_cursor' => $this->previousCursor()?->encode(),
            ],
            'links' => [
                'next' => $this->nextPageUrl(),
                'prev' => $this->previousPageUrl(),
            ],
        ];
    }
}
