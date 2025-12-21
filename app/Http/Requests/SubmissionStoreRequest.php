<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// https://laravel.com/docs/12.x/validation#creating-form-requests
class SubmissionStoreRequest extends FormRequest
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
            'current_odometer' => 'required|integer|min:0|gte:previous_oil_change_odometer',
            'previous_oil_change_date' => 'required|date|before:today',
            'previous_oil_change_odometer' => 'required|integer:min:0',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'current_odometer.required' => 'Odometer is required',
            'current_odometer.integer' => 'Odometer must be a number',
            'current_odometer.min' => 'Odometer must be a positive number',
            'current_odometer.gte' => 'Odometer need to be greater than equal to Odemeter at Previous Oil Change',
            'previous_oil_change_date.required' => 'Date of Previous Oil Change is required',
            'previous_oil_change_date.date' => 'Date of Previous Oil Change must be valid date',
            'previous_oil_change_date.before' => 'Date of Previous Oil Change date must be in the past',
            'previous_oil_change_odometer.required' => 'Odemeter at Previous Oil Change is required',
            'previous_oil_change_odometer.integer' => 'Odemeter at Previous Oil Change must be a number',
            'previous_oil_change_odometer.min' => 'Odemeter at Previous Oil Change must be a positive number',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [

        ];
    }
}
