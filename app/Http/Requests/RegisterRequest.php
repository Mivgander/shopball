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
            'nick' => 'bail|required|string|alphaDash|min:3|max:40',
            'email' => ['bail', 'required', 'email', 'max:30', new EmailExist],
            'password' => 'bail|required|string|min:6'
        ];
    }

    public function messages()
    {
        return [
            'nick.required' => 'Nie podano nazwy użytkownika',
            'nick.string' => 'Nazwa użytkownika musi być ciągiem znaków',
            'nick.alpha_dash' => 'Nazwa użytkownika może zawierać tylko litery, cyfry, myślniki oraz podkreślenia',
            'nick.min' => [
                'string' => 'Nazwa użytkownika musi składać się z conajmniej :min znaków'
            ],
            'nick.max' => [
                'string' => 'Nazwa użytkownika musi składać się maksymalnie z :max znaków'
            ],
            'email.required' => 'Nie podano emaila',
            'emial.email' => 'Podany email nie spełnia warunków',
            'email.max' => [
                'string' => 'Email musi składać się z maksymalnie :max znaków'
            ],
            'password.required' => 'Nie podano hasła',
            'password.string' => 'Hasło musi być ciągiem znaków',
            'password.min' => [
                'string' => 'Hasło musi składać się z conajmniej :min znaków'
            ]
        ];
    }
}
