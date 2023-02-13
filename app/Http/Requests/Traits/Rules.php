<?php

namespace App\Http\Requests\Traits;

trait Rules
{
    public function rules(): array
    {
        $methodName = collect(explode(".", $this->route()->getName()))
            ->transform(fn ($str, $key) => ($key != 0) ? ucwords($str) : $str)
            ->implode("");

        return $this->$methodName();
    }
}

