<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class Boolean implements ValidationRule
{
    /**
     * @param bool $required_value
     */
    public function __construct(protected bool $required_value)
    {
        //
    }

    /**
     * Run the validation rule.
     *
     * @param Closure(string, ?string=): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $converted_res = $this->required_value ? 'true' : 'false';
        if ($value !== $this->required_value) {
            $fail('validation.boolean_value')->translate(['boolean' => $converted_res]);
        }
    }
}
