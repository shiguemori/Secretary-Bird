<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsuarioRequest extends FormRequest
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
                'nome' => 'required|max:50',
                'sobrenome' => 'required|max:170',
                'email' => 'required|max:200|email|unique:usuarios,email,' . $this->request->get('id'),
                'status_id' => 'required',
                'password' => 'nullable|min:6|confirmed',
                'password_confirmation' => 'nullable|required_with:password|min:6'
            ];
        }
        return [];
    }

}
