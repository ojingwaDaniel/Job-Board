<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Job;

use Illuminate\Validation\Rule;


class JobRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
             'title' => "required|string|max:255",
            "description" => "required|string",
            'location'=> "required|string",
            "salary" => "required|numeric|min:200",
            "experience"  =>['required',Rule::in(Job::$experience)],
            "category" => ['required', Rule::in(Job::$category)]
        ];
    }
}
