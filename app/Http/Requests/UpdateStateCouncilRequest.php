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
        $courseDetailIds = $this->input('course_detail_ids');
        if (is_string($courseDetailIds)) {
            $courseDetailIds = array_filter(array_map('intval', explode(',', $courseDetailIds)));
        }
        $this->merge([
            'course_detail_ids' => $courseDetailIds ?: [],
            'pass_percentage' => $this->parseArrayInput($this->input('pass_percentage')),
            'mrp' => $this->parseArrayInput($this->input('mrp')),
            'price' => $this->parseArrayInput($this->input('price')),
            'points' => $this->parseArrayInput($this->input('points')),
            'valid_days' => $this->parseArrayInput($this->input('valid_days'), 'intval'),
            'active_status' => $this->boolean('active_status'),
        ]);
    }

    /**
     * @param  array<int, mixed>|string|null  $value
     * @return array<int, mixed>
     */
    private function parseArrayInput(mixed $value, ?callable $cast = null): array
    {
        if (is_array($value)) {
            $value = array_filter($value);
        } else {
            $value = $value ? array_filter(array_map('trim', explode(',', (string) $value))) : [];
        }

        return $cast ? array_map($cast, $value) : array_values($value);
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
            'course_detail_ids' => ['required', 'array', 'min:1'],
            'course_detail_ids.*' => ['required', 'exists:course_details,id'],
            'pass_percentage' => ['nullable', 'array'],
            'pass_percentage.*' => ['nullable', 'numeric'],
            'mrp' => ['nullable', 'array'],
            'mrp.*' => ['nullable', 'numeric'],
            'price' => ['nullable', 'array'],
            'price.*' => ['nullable', 'numeric'],
            'points' => ['nullable', 'array'],
            'points.*' => ['nullable', 'numeric'],
            'valid_days' => ['nullable', 'array'],
            'valid_days.*' => ['nullable', 'integer'],
            'active_status' => ['boolean'],
        ];
    }
}
