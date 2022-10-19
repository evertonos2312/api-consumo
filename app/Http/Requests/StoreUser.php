<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreUser extends FormRequest
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
        $id = $this->user ?? '';
        return [
            'name' => ['required', 'min:3', 'max:64'],
            'email' => ['required', 'min:3', 'max:255', "unique:users,email,{$id},id"],
            'password' => ['required', 'confirmed', Password::min(6)->letters()->mixedCase()->numbers()->symbols()],
            'permission_code' => ['required', 'integer', 'numeric', Rule::in([env('REGISTER_USER'), env('ADMIN_USER')])]
        ];
    }
}
