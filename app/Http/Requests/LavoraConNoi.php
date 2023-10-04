<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LavoraConNoi extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(auth()->check()){
            return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'file' => 'required|mimes:doc,odt,pdf',
        ];
    }

    public function messages(){
        return [
            'file'=> [
                'required' => 'Nessun file allegato.',
                'mimes' => 'Estesione file allegato errata.',
            ]
        ];
    }
}
