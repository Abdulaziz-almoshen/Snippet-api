<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SnippetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'title' => $this->title,
            'steps_count' => $this->steps()->count(),
            'is_public' => $this->is_public,
            'step' => new Steps($this->steps),
            'author' => new PublicUserResource($this->user),
            'owner' => $this->getCheckOwner(),

        ];
    }



    /**
     * @return boolean
     */
    public function getCheckOwner()
    {
        return $this->user->id === optional(auth()->user())->id;
    }
}
