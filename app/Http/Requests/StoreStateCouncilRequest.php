<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStateCouncilRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $courses = $this->input('courses', []);
        if (is_array($courses)) {
            foreach ($courses as $id => $settings) {
                $courses[$id]['pass_percentage'] = $this->parseArrayInput($settings['pass_percentage'] ?? []);
                $courses[$id]['mrp'] = $this->parseArrayInput($settings['mrp'] ?? []);
                $courses[$id]['offer_price'] = $this->parseArrayInput($settings['offer_price'] ?? []);
                $courses[$id]['points'] = $this->parseArrayInput($settings['points'] ?? []);
                $courses[$id]['valid_days'] = $this->parseArrayInput($settings['valid_days'] ?? [], 'intval');
            }
        }

        $this->merge([
            'courses' => $courses,
            'active_status' => $this->boolean('active_status'),
        ]);
    }

    /**
     * @param  array<int, mixed>|string|null  $value
     * @return array<int, mixed>
     */
    private function parseArrayInput(mixed $value, ?callable $cast = null): array
    {
        // If it's already an array (old behavior or multi-select), process each element
        if (is_array($value)) {
            $value = array_map(fn($v) => ($v === '' || $v === null) ? null : $v, $value);
        } else {
            // If it's a scalar (new simplified UI), wrap it in a single-element array
            $value = ($value === '' || $value === null) ? [null] : [$value];
        }

        return $cast ? array_map(fn($v) => $v === null ? null : $cast($v), $value) : $value;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
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
            'courses.*.valid_days' => ['nullable', 'integer'],
            'active_status' => ['boolean'],
        ];
    }
}
