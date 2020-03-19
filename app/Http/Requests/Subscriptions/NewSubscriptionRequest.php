<?php

namespace App\Http\Requests\Subscriptions;

use Illuminate\Foundation\Http\FormRequest;

class NewSubscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'userId' => 'required',
            'reference' => 'required',
            'planId' => 'required',
        ];
    }

    /**
     * Get the custom validation messages that apply to the incoming request.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'userId.required' => 'The user\'s id must be supplied.',
            'reference.required' => 'The transaction reference must be supplied.',
            'planId.required' => 'The plan id must be supplied.',
        ];
    }
}
