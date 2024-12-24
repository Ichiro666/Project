<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use ReCaptcha\ReCaptcha;

class Captcha implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $recaptcha = new ReCaptcha(config('services.recaptcha.secret_key'));
        $response = $recaptcha->verify($value, $_SERVER['REMOTE_ADDR']);

        if (!$response->isSuccess()) {
            $fail('The captcha verification failed.');
        }
    }
}
