<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Base64Types implements Rule
{
    /**
     * Valid image types
     *
     * @var array
     */
    private $types = [];

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($types)
    {
        $this->types = $types;
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
        foreach ($this->types as $type) {
            if( starts_with($value, "data:image/$type") ) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid image.';
    }
}
