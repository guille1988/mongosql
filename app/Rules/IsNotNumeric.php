<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsNotNumeric implements Rule
{
    public function passes($attribute, $value): bool
    {
        return !is_numeric($value);
    }

    public function message(): string
    {
        $attribute = ':attribute';

        return __("Field $attribute can't be only numbers");
    }
}
