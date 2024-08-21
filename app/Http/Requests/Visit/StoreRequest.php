<?php

namespace App\Http\Requests\Visit;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // 'price' => 'decimal:0,7'
        return [
            'name' => 'required|min:3|max:150',
            'email' => 'required|min:12|max:150|email:rfc',
            'latitude' => 'required|decimal:0,7|between:-999.9999999,999.9999999',
            'longitude' => 'required|decimal:0,7|between:-999.9999999,999.9999999'
        ];
    }
}
