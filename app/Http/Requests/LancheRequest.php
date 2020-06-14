<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LancheRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
       switch ($this->method()) {
           case 'POST': 
            return [
                'nome' => 'required',
                'descricao' => 'required',
                'preco' => 'required',
           ];

           case 'PUT': 
            return [
                'nome' => 'required',
                'descricao' => 'required',
                'preco' => 'required',
        ];
       }
    }
}
