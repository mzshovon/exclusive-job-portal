<?php

namespace App\Http\Requests;

use App\Traits\FormValidationResponse;
use Illuminate\Foundation\Http\FormRequest;

class UserOtpAuthorizationRequest extends FormRequest
{
    use FormValidationResponse;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "mobile_number : required|numeric|max:11",
            "otp : required|numeric|max:6"
        ];
    }
}
