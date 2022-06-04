<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required',
            'id_user' => 'required',
            'value' => 'required|numeric',
            'stock' => 'required|numeric',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'id_user.required'  => 'O campo usuário é obrigatório',
            'value.required' => 'O campo valor é obrigatório',
            'stock.required' => 'O campo estoque é obrigatório',
            'description.required' => 'O campo descrição é obrigatório',
            'value.numeric' => 'O campo valor deve ser numérico',
            'stock.numeric' => 'O campo estoque deve ser numérico',
        ];
    }
}
