<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CautelaFormRequest extends FormRequest
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
            'data'=>'required|max:10',
            'validade'=>'max:10',
            'qtdMunicao'=>'required|numeric',
            'qtdCarregador'=>'required|numeric',
            'observacao'=>'required|max:250',
            'idArma'=>'required',
            'idRequerente'=>'required',
            'idSignatario'=>'required'
        ];
    }
}
