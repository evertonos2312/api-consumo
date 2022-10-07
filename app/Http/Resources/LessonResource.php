<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $max_cancelamento = $this->max_cancelamento ? Carbon::createFromFormat('Y-m-d H:i:s',$this->max_cancelamento)->format(' d/m/Y H:i') : null;
        return [
            'identify' => $this->id,
            'status' => $this->status ? 'ativo' : 'inativo',
            'imagem' => $this->imagem,
            'link' => $this->link,
            'inicio' => Carbon::createFromFormat('Y-m-d H:i:s',$this->inicio)->format(' d/m/Y H:i'),
            'termino' => Carbon::createFromFormat('Y-m-d H:i:s',$this->termino)->format(' d/m/Y H:i'),
            'max_cancelamento'        => $max_cancelamento,
            'instrutor'               => $this->instrutor,
            'moderador'               => $this->moderador,
            'periodo'                 => $this->periodo,
            'carga_horaria'           => $this->carga_horaria,
            'dias_curso'              => $this->dias_curso,
            'destaque'                => $this->destaque,
            'descricao'               => $this->descricao,
            'pre_requisitos'          => $this->pre_requisitos,
            'objetivo'                => $this->objetivo,
            'aviso'                   => $this->aviso,
            'vagas_cliente'           => $this->vagas_cliente,
            'vagas_nao_cliente'       => $this->vagas_nao_cliente,
            'vagas_lista_cliente'     => $this->vagas_lista_cliente,
            'vagas_lista_nao_cliente' => $this->vagas_lista_nao_cliente,
            'valor_cliente'           => $this->valor_cliente,
            'valor_nao_cliente'       => $this->valor_nao_cliente,
            'id_mp'                   => $this->id_mp,
        ];
    }
}
