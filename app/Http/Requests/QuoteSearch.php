<?php

namespace App\Http\Requests;

use App\Models\QuoteConfig;
use Illuminate\Foundation\Http\FormRequest;

class QuoteSearch extends FormRequest
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
        $rules = [
            'category' => 'required',
            'service_id' => 'required',
            'make' => 'required',
            'model' => 'required',
            'options' => 'array',
        ];

        // Add validation rules for dynamic fields
        $options = $this->input('options');
        foreach ($options as $key => $value) {
            if ($key != 'type-of-key') {
                $rules["options.{$key}"] = ['required']; // Add your specific rules for each dynamic field
            }
        }

        return $rules;
    }
}
