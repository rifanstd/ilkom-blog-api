<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'user_id' => $this->author_id,
            'category_name' => $this->category->name,
            'user_name' => $this->user->name,
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
        ];
    }
}