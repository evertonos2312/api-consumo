<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateLesson extends FormRequest
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
            'course' => ['required', 'exists:courses,id'],
            'status' => ['nullable', 'boolean'],
            'imagem' => ['nullable', 'min:3', 'max:255'],
            'inicio' => ['required', 'date_format:d/m/Y H:i'],
            'termino' => ['required' ,'date_format:d/m/Y H:i'],
            'max_cancelamento' => ['nullable', 'date_format:d/m/Y H:i'],
            'id_mp' => ['nullable', 'integer', 'numeric']
        ];
    }
}
