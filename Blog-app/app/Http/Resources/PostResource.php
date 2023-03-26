<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

// use Illuminate\Http\Resources\UserResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * 
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'created_at' => $this->created_at,
             'user' => new UserResource($this->user) 
        ];
    }
}