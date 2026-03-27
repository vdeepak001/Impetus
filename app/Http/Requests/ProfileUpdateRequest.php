<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => [
                'sometimes',
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'phone' => ['nullable', 'string', 'max:255'],
            'designation' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'address' => ['nullable', 'string', 'max:255'],
            'address_line_1' => ['nullable', 'string', 'max:255'],
            'address_line_2' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'district' => ['nullable', 'string', 'max:255'],
            'state' => ['nullable', 'string', 'max:255'],
            'zip_code' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'gender' => ['nullable', 'string', 'max:50'],
            'date_of_birth' => ['nullable', 'date'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'twitter_url' => ['nullable', 'url', 'max:255'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'tax_id' => ['nullable', 'string', 'max:255'],
            'pan_number' => ['nullable', 'string', 'max:255'],
            'aadhar_number' => ['nullable', 'string', 'max:255'],
            'rn_number' => ['nullable', 'string', 'max:255'],
            'rm_number' => ['nullable', 'string', 'max:255'],
            'qualification' => ['nullable', 'string', 'max:255'],
            'academic_state' => ['nullable', 'string', 'max:255'],
            'institution_name' => ['nullable', 'string', 'max:255'],
            'completed_year' => ['nullable', 'string', 'max:255'],
            'total_years_experience' => ['nullable', 'string', 'max:255'],
            'organization_name' => ['nullable', 'string', 'max:255'],
            'organization_type' => ['nullable', 'string', 'max:255'],
            'department_name' => ['nullable', 'string', 'max:255'],
            'professional_address_line_1' => ['nullable', 'string', 'max:255'],
            'professional_address_line_2' => ['nullable', 'string', 'max:255'],
            'professional_city' => ['nullable', 'string', 'max:255'],
            'professional_district' => ['nullable', 'string', 'max:255'],
            'professional_state' => ['nullable', 'string', 'max:255'],
        ];
    }
}
