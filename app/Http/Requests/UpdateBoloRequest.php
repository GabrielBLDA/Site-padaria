<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateBoloRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'nome' => [
                'required',
                'string',
                'max:255',
                Rule::unique('bolos', 'nome')->ignore($this->route('bolo')),
            ],
            'peso' => 'required|numeric|min:0',
            'valor' => 'required|numeric|min:0',
            'qtd_disponivel' => 'required|integer|min:0',
            'imagem' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Ajuste conforme necessário
        ];
    }

    public function messages()
{
    return [
        'nome.required' => 'O nome do bolo é obrigatório.',
        'nome.unique' => 'Já existe um produto com este nome.',
        'peso.required' => 'O peso do bolo é obrigatório.',
        'peso.numeric' => 'O peso deve ser um valor numérico.',
        'peso.min' => 'O peso deve ser um valor positivo.',
        'valor.required' => 'O valor do bolo é obrigatório.',
        'valor.numeric' => 'O valor deve ser um número.',
        'valor.min' => 'O valor deve ser maior ou igual a zero.',
        'qtd_disponivel.required' => 'A quantidade disponível é obrigatória.',
        'qtd_disponivel.integer' => 'A quantidade deve ser um número inteiro.',
        'qtd_disponivel.min' => 'A quantidade deve ser maior ou igual a zero.',
    ];
}
}
