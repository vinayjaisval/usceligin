<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SendOtpRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'contact' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $method = $this->input('method', 'phone');

                    if ($method === 'phone') {
                        $this->validatePhone($value, $fail);
                    } else {
                        $this->validateEmail($value, $fail);
                    }
                }
            ],
            'method' => 'required|in:phone,email'
        ];
    }

    /**
     * Validate phone number
     */
    private function validatePhone($phone, $fail): void
    {
        // Remove all non-numeric characters for validation
        $cleanPhone = preg_replace('/[^0-9]/', '', $phone);

        // Check if empty after cleaning
        if (empty($cleanPhone)) {
            $fail('Phone number is required.');
            return;
        }

        // Check length (10 digits for Indian mobile numbers)
        if (strlen($cleanPhone) < 10) {
            $fail('Phone number must be at least 10 digits.');
            return;
        }

        if (strlen($cleanPhone) > 12) {
            $fail('Phone number cannot exceed 12 digits.');
            return;
        }

        // For 10-digit numbers, validate Indian mobile format
        if (strlen($cleanPhone) === 10) {
            if (!preg_match('/^[6-9][0-9]{9}$/', $cleanPhone)) {
                $fail('Please enter a valid Indian mobile number.');
                return;
            }
        }

        // For 12-digit numbers, validate with country code
        if (strlen($cleanPhone) === 12) {
            if (!preg_match('/^91[6-9][0-9]{9}$/', $cleanPhone)) {
                $fail('Please enter a valid Indian mobile number with country code.');
                return;
            }
        }

        // Invalid length
        if (!in_array(strlen($cleanPhone), [10, 12])) {
            $fail('Phone number must be 10 digits or 12 digits with country code.');
        }
    }

    /**
     * Validate email address
     */
    private function validateEmail($email, $fail): void
    {
        // Basic email validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $fail('Please enter a valid email address.');
            return;
        }

        // Check email length
        if (strlen($email) > 254) {
            $fail('Email address is too long.');
            return;
        }

        // Check local part length (before @)
        $parts = explode('@', $email);
        if (isset($parts[0]) && strlen($parts[0]) > 64) {
            $fail('Email local part is too long.');
            return;
        }

        // Additional email format validation
        if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
            $fail('Please enter a valid email address format.');
        }
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'contact.required' => 'Phone number or email is required.',
            'method.required' => 'Verification method is required.',
            'method.in' => 'Verification method must be phone or email.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'contact' => 'contact information',
            'method' => 'verification method',
        ];
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
                'error_code' => 'VALIDATION_FAILED'
            ], 422)
        );
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $contact = $this->input('contact');
        $method = $this->input('method', 'phone');

        // Clean and normalize contact based on method
        if ($method === 'phone' && $contact) {
            // Remove spaces and special characters but keep numbers
            $cleanContact = preg_replace('/[^0-9]/', '', $contact);
            $this->merge(['contact' => $cleanContact]);
        } elseif ($method === 'email' && $contact) {
            // Trim and lowercase email
            $cleanContact = strtolower(trim($contact));
            $this->merge(['contact' => $cleanContact]);
        }
    }
}