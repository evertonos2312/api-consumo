<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

class SubmoduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'identify' => $this->id,
            'nome' => $this->nome,
            'id_mp' => $this->id_mp,
            'status' => $this->status ? 'active' : 'inactive',
            'data' => Carbon::make($this->created_at)->format('Y-m-d'),
        ];
    }
}
