<?php

namespace App\Http\Requests\Traits;

use App\Exceptions\ApiValidationException;
use Illuminate\Contracts\Validation\Validator;
use Override;

trait FailedValidation
{
    
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    #[Override]    
    /**
     * Summary of failedValidation
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @throws \App\Exceptions\ApiValidationException
     * @return never
     */
    protected function failedValidation(Validator $validator)
    {
        throw new ApiValidationException($validator);
    }
}