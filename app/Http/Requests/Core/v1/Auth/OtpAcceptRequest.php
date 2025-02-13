<?php

namespace App\Http\Requests\Core\v1\Auth;

use App\Http\Requests\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class OtpAcceptRequest extends FormRequest
{
    use FailedValidation;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Summary of rules
     * @return array{code: string, phone: string}
     */
    public function rules(): array
    {
        return [
            'phone' => 'required|numeric|digits:12',
            'code' => 'required|numeric|digits:6'
        ];
    }
}