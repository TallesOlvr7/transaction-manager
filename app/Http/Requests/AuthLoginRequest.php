<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthLoginRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'email'=>'required|email',
            'password'=>'required|min:6'
        ];
    }

    public function messages():array
    {
        return[
            'email.required'=>'O emai-l é obrigatório.',
            'email.email' => 'Por favor, insira um e-mail válido.',
            'password.required'=>'A senha é obrigatória.',
            'password.min'=>'A senha deve ter no mínimo 6 caracteres.'
        ];
    }
}
