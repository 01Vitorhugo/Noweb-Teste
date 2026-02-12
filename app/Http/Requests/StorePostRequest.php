<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
   public function rules(): array
{
    return [
        'title'       => 'required|max:255|min:5',
        'category_id' => 'required|exists:categories,id',
        'tag'         => 'nullable|string|max:50',
        'summary'     => 'required|max:500',
        'content'     => 'required',
    ];
}

public function messages(): array
{
    return [
        'title.required'       => 'O título da notícia é obrigatório.',
        'title.min'            => 'O título deve ter pelo menos 5 caracteres.',
        'category_id.required' => 'Selecione uma categoria para a notícia.',
        'category_id.exists'   => 'A categoria selecionada é inválida.',
        'summary.required'     => 'O resumo é essencial para a listagem.',
        'content.required'     => 'O corpo da notícia não pode estar vazio.',
    ];
}
}
