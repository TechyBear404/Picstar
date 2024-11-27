<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoSpaces implements Rule
{
    public function passes($attribute, $value)
    {
        return strpos($value, ' ') === false;
    }

    public function message()
    {
        return "Le pseudo ne peut pas contenir d'espaces.";
    }
}
