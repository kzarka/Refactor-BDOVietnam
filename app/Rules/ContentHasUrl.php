<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ContentHasUrl implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    const REGEX = '/(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?/';

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
        
        return !preg_match(self::REGEX, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Comment không thể chứa URL';
    }
}
