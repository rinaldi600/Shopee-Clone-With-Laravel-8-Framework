<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Buyer;
use Illuminate\Support\Facades\Hash;

class CheckPassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $param;
    public function __construct($params)
    {
        $this->param = $params;
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
        $passwordHash = Buyer::where('username', $this->param)->first();
        if (empty($passwordHash)) {
            return false;
        } else {
            if (Hash::check($value, $passwordHash['password'])) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Password Salah';
    }
}
