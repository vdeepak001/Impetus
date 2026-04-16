<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStateCouncilRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    protected function prepareForValidation(): void
    {
        $courses = $this->input('courses', []);
        if (is_array($courses)) {
            foreach ($courses as $id => $settings) {
                // Ensure values are treated as scalars for validation
                $courses[$id]['pass_percentage'] = isset($settings['pass_percentage']) ? $settings['pass_percentage'] : null;
                $courses[$id]['mrp'] = isset($settings['mrp']) ? $settings['mrp'] : null;
                $courses[$id]['offer_price'] = isset($settings['offer_price']) ? $settings['offer_price'] : null;
                $courses[$id]['points'] = isset($settings['points']) ? $settings['points'] : null;
                $courses[$id]['valid_days'] = isset($settings['valid_days']) ? $settings['valid_days'] : null;
            }
        }

        $this->merge([
            'courses' => $courses,
            'active_status' => $this->boolean('active_status'),
        ]);
    }




    public function authorize(): bool
    {
        return in_array($this->user()?->role_type, ['superadmin', 'admin'], true);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'state_id' => ['required', 'exists:states,id'],
            'council_name' => ['nullable', 'string', 'max:255'],
            'courses' => ['required', 'array', 'min:1'],
            'courses.*.pass_percentage' => ['nullable', 'numeric'],
            'courses.*.mrp' => ['nullable', 'numeric'],
            'courses.*.offer_price' => ['nullable', 'numeric'],
            'courses.*.points' => ['nullable', 'numeric'],
            'courses.*.valid_days' => ['nullable', 'integer'],
            'active_status' => ['boolean'],
            'split_up' => ['required', 'array'],
            'split_up.*' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
