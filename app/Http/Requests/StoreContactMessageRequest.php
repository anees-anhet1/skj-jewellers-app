<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Public form — anyone can submit
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'phone'   => 'required|digits:10',
            'message' => 'required|string|min:10|max:2000',
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'name.required'    => 'Please enter your name.',
            'email.required'   => 'Please enter your email address.',
            'email.email'      => 'Please enter a valid email address.',
            'phone.required'   => 'Please enter your phone number.',
            'phone.digits'     => 'Please enter exactly 10 digits for the phone number.',
            'message.required' => 'Please enter your message.',
            'message.min'      => 'Your message must be at least 10 characters.',
            'message.max'      => 'Your message cannot exceed 2000 characters.',
        ];
    }
}
