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
              'id' => $this->id   ,
              'category_id' => $this->category_id   ,
              'title' => $this->title   ,
              'description' => $this->description   ,
              'is_active' => $this->is_active   ,
              'posted_by' => $this->posted_by   ,
              'posted_by_user' => $this->user->name ,
              'posted_by_img' => '/project-assets/images/man'.rand(1,4).'.png',
              'posted_img' => '/project-assets/images/post_'.rand(1,4).'.jpg',
        ];
    }
}
