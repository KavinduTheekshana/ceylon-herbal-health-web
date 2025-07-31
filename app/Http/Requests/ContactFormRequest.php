<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fname' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s\-\'\.]+$/'],
            'lname' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s\-\'\.]+$/'],
            'email' => ['required', 'email:rfc,dns', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20', 'regex:/^[\+]?[0-9\s\-\(\)]+$/'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
        ];
    }

    /**
     * Get custom validation messages.
     */
    public function messages(): array
    {
        return [
            'fname.required' => 'First name is required.',
            'fname.regex' => 'First name contains invalid characters.',
            'lname.required' => 'Last name is required.',
            'lname.regex' => 'Last name contains invalid characters.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'phone.regex' => 'Please enter a valid phone number.',
            'message.required' => 'Message is required.',
            'message.min' => 'Message must be at least 10 characters long.',
            'message.max' => 'Message cannot exceed 2000 characters.',
        ];
    }

    /**
     * Get custom attribute names for validation errors.
     */
    public function attributes(): array
    {
        return [
            'fname' => 'first name',
            'lname' => 'last name',
            'email' => 'email address',
            'phone' => 'phone number',
            'message' => 'message',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'fname' => trim($this->fname),
            'lname' => trim($this->lname),
            'email' => strtolower(trim($this->email)),
            'phone' => $this->phone ? trim($this->phone) : null,
            'message' => trim($this->message),
        ]);
    }
}