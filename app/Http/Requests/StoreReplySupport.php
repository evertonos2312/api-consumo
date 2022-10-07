<?php

namespace App\Http\Requests;

use App\Models\ReplySupport;
use App\Models\Support;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreReplySupport extends FormRequest
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
            'support' => ['required', 'exists:supports,id'],
            'description' => ['required', 'min:3', 'max:10000']
        ];
    }
}
