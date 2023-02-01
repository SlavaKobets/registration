<?php

namespace App\Rules;

use App\Formatting;
use App\Models\Country;
use Illuminate\Contracts\Validation\Rule;

class PhoneLengthRule implements Rule
{
    use Formatting;
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
    public function passes($attribute, $value): bool
    {
        $country = Country::query()->find((int)$value['country']);
        return strlen($this->modifyPhone($value['phone'])) == (strlen($country->calling_code) + 9);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Phone number is incorrect';
    }
}
