<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CatastropheUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'valeur' => ['required', 'numeric'],
            'url' => ['nullable', 'url'],
            'alea_id' => ['required', 'exists:aleas,id'],
            'ville_id' => ['required', 'exists:villes,id'],
        ];
    }
}
