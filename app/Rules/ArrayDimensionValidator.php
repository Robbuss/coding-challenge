<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ArrayDimensionValidator implements Rule
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
        if(!$value || count($value) === 0)
            return true;

        foreach($value as $row){
            if(count($value[0]) !== count($row))
                return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Not every row has the same amount of columns';
    }
}
