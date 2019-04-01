<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdministradorRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return [
                'nome' => 'required|max:40',
                'sobrenome' => 'required|max:100',
                'email' => 'required|max:200|email|unique:administradores,email,' . $this->request->get('id'),
                'grupos.*' => 'required',
                'status_id' => 'required',
                'password' => 'nullable|min:6|confirmed',
                'password_confirmation' => 'nullable|required_with:password|min:6'
            ];
        }

        return [];
    }
}
