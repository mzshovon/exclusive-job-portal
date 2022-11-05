<?php

namespace App\Http\Requests;

use App\Traits\FormValidationResponse;
use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionsAnswersResultRequest extends FormRequest
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
            "parentId" => ['required','exists:subjects,id'],
            "questions.*" => ['required'],
            "answers.*" => ['required']
        ];
    }
}
