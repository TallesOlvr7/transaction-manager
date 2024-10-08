<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionCreateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'payee'=>'required|exists:users,id',
            'value'=>'required|gt:0'
        ];
    }

    public function messages():array
    {
        return[
            'payee.required'=>'É necessário informar quem vai receber a transação.',
            'payee.exists'=>'Usuário não encontrado',
            'value.required'=>'Deve-se passar o valor da transação.',
            'value.gt'=>'A transação deve ter um valor maior que zero.'
        ];
    }
}
