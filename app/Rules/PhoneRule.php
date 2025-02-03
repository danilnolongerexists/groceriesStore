<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneRule implements ValidationRule
{
    private $countryCode;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($countryCode = 'ru')
    {
        $this->countryCode = $countryCode;
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
        $digits = preg_replace('/[^0-9]/', '', $value);

        if ($this->countryCode == 'ru') {
            if (substr($digits, 0, 1) == '7' && strlen($digits) == 11) {
                return true;
            }
            if (substr($digits, 0, 1) == '8' && strlen($digits) == 11) {
                return true;
            }
            if (substr($digits, 0, 1) == '9' && strlen($digits) == 10) {
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
        return 'Номер телефона должен быть в формате +7 999 999 99 99';
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }
}
