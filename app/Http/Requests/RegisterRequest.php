<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\EmailExist;

class RegisterRequest extends FormRequest
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
            'nick' => 'bail|required|alphaDash|min:3|max:40',
            'email' => ['bail', 'required', 'email', new EmailExist],
            'password' => 'bail|required|min:6'
        ];
    }

    public function messages()
    {
        return [
            'nick.required' => 'Nie podano nazwy użytkownika',
            'nick.alpha_dash' => 'Nazwa użytkownika może zawierać tylko litery, cyfry, myślniki oraz podkreślenia',
            'nick.min' => [
                'string' => 'Nazwa użytkownika musi składać się z conajmniej :min znaków'
            ],
            'nick.max' => [
                'string' => 'Nazwa użytkownika musi składać się maksymalnie z "max znaków'
            ],
            'email.required' => 'Nie podano emaila',
            'emial.email' => 'Podany email nie spełnia warunków',
            'password.required' => 'Nie podano hasła',
            'password.min' => [
                'string' => 'Hasło musi składać się z conajmniej :min znaków'
            ]
        ];
    }
}
