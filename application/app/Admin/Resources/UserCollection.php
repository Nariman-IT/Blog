<?php

namespace App\Admin\Resources;

use App\User\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    public $collects = UserResource::class;

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
