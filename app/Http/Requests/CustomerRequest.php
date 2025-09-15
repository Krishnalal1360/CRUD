<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
    //
    //protected $model = 'customers';
    //
    public function rules(): array
    {
        return [
            //
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,bmp,webp,gif', 'max:2048'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:customers,email', 'email:rfc,dns,spoof,filter'],
            'phone' => ['required', 'string', 'unique:customers,phone', 'regex:/^\+[1-9][0-9]{0,2}[0-9]{6,12}$/'],
            'bank_account_number' => ['required', 'string', 'unique:customers,bank_account_number', 'regex:/^([0-9]{9,18}|[A-Z0-9]{15,34})$/'],
            'about' => ['nullable', 'string', 'max:500'],
        ];
    }
}
