<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class OpisLength implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return (strlen(strip_tags(str_replace('&nbsp;', '', preg_replace("/[\n\r]/","", $value)))) < 255);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Opis produktu nie może być dłuższy niż 255 znaków.';
    }
}
