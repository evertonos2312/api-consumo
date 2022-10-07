<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ModuleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'identify' => $this->id,
            'nome' => $this->nome,
            'id_mp' => $this->id_mp,
            'status' => $this->status ? 'active' : 'inactive',
            'data' => Carbon::make($this->created_at)->format('Y-m-d'),
            'submodules' => SubmoduleResource::collection($this->whenLoaded('submodules'))
        ];
    }
}
