<?php

namespace App\Rules;

use App\Repositories\Interfaces\TaskRepositoryInterface;
use Illuminate\Contracts\Validation\Rule;

class RejectIfHasPosts implements Rule
{

    public function passes($attribute, $value): bool
    {
        return app(TaskRepositoryInterface::class)->find($value)->posts->isEmpty();
    }

    public function message(): string
    {
        return "This record can't be deleted,
            because it has relations to posts table.
            Please delete those records first and try again";
    }
}
