<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:6'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Nie podano emaila',
            'emial.email' => 'Podany email nie spełnia warunków',
            'password.required' => 'Nie podano hasła',
            'password.min' => [
                'string' => 'Hasło musi składać się z conajmniej :min znaków'
            ]
        ];
    }
}
