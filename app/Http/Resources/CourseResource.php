<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'nome' => $this->nome,
            'categoria' => $this->categoria,
            'subcategoria' => $this->subcategoria,
            'tipo' => $this->tipo,
            'destaque' => $this->destaque,
            'id_mp' => $this->id_mp,
            'data' => Carbon::make($this->created_at)->format('Y-m-d'),
            'turmas' => LessonResource::collection($this->whenLoaded('lessons'))
        ];
    }
}
