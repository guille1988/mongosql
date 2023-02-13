<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsValid implements Rule
{
    public function __construct(private readonly string $repository){}

    public function passes($attribute, $value): bool
    {
        return !empty(app($this->repository)->find($value));
    }
    public function message(): string
    {
        return "This record doesn't exist, please try again";
    }
}
