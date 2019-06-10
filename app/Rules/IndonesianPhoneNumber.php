<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IndonesianPhoneNumber implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return substr($value,0,3) == '+62';
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Harap menggunakan penulisan nomor internasional.';
    }
}
