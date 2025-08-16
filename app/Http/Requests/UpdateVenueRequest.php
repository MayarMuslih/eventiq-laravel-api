<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVenueRequest extends FormRequest
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
            'venue_name' => [
                'sometimes',
                'nullable',
                'string',
                Rule::unique('venues', 'venue_name')->ignore($this->route('venue')),
            ],
            'address' => 'sometimes|required|string',
            'capacity' => 'sometimes|required|integer|min:10',
            'venue_price' => 'sometimes|required|numeric|min:0',
        ];
    }
}
