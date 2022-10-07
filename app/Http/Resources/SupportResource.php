<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SupportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'identify' => $this->id,
            'status' => $this->status,
            'status_label' =>   $this->statusOptions[$this->status] ?? null,
            'description' => $this->description,
            'last_updated' => Carbon::make($this->updated_at)->format('Y-m-d H:i:s'),
            'user' => new UserResource($this->user),
            'lesson' => new LessonResource($this->lesson),
            'replies' => ReplySupportResource::collection($this->replies)
        ];
    }
}
