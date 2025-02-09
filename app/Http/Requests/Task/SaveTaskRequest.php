<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class SaveTaskRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'priority' => 'integer',
            'project_id' => ['required_without:new_project_name', 'prohibits:new_project_name'],
            'new_project_name' => ['required_without:project_id', 'prohibits:project_id'],
        ];
    }
}
