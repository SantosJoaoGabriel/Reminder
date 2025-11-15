<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReminderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id'        => 'sometimes|required|exists:users,id',
            'titulo'         => 'sometimes|required|string|max:20',
            'descricao'      => 'sometimes|required|string|max:40',
            'data_lembrete'  => 'sometimes|required|date',
            'previsao_clima' => 'nullable|string|max:50',
        ];
    }

    public function messages(): array {
        return [
            'user_id.required'        => 'O usuário é obrigatório.',
            'user_id.exists'          => 'Selecione um usuário válido.',
            'titulo.required'         => 'O título é obrigatório.',
            'titulo.max'              => 'O título deve ter até 20 caracteres.',
            'descricao.required'      => 'A descrição é obrigatória.',
            'descricao.max'           => 'A descrição deve ter até 40 caracteres.',
            'data_lembrete.required'  => 'A data do lembrete é obrigatória.',
            'data_lembrete.date'      => 'Informe uma data válida.',
        ];
    }
}