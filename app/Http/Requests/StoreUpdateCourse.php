<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCourse extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nome' => ['required', 'min:3', 'max:255'],
            'categoria' => ['nullable', 'exists:modules,id'],
            'subcategoria' => ['nullable', 'exists:submodules,id'],
            'tipo' => ['nullable', 'min:2', 'max:255'],
            'destaque' => ['nullable', 'boolean'],
            'especializacao' => ['nullable', 'boolean'],
            'id_mp' => ['nullable', 'integer', 'numeric']
        ];
    }
}
