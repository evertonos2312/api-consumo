<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ConfigEnergiaResource extends JsonResource
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
            'atual' => $this->atual ? 'Sim' : 'Não',
            'valor_kwh' => $this->valor_kwh,
            'meta_kwh' => $this->meta_kwh,
            'data' => Carbon::make($this->created_at)->format('Y-m-d'),
        ];
    }
}
