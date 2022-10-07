<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateSubmodule extends FormRequest
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
            'module' => ['required', 'exists:modules,id'],
            'status' => ['nullable', 'boolean'],
            'id_mp' => ['nullable', 'integer', 'numeric']
        ];
    }
}
