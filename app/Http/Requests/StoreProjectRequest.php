<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'title' => 'required|min:5|max:50',
            'description' => 'nullable',
            'stack' => 'required'
        ];
    }

    public function messages(){
        return [
            'title.required' => 'Il titolo è obbligatorio!',
            'title.min' => 'Il titolo non può essere più corto di 5 caratteri!',
            'title.max' => 'Il titolo non può essere più lungo di 50 caratteri!',
            'stack.required' => 'Lo stack deve essere incluso!'
        ];
    }
}
