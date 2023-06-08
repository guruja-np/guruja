<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return (auth()->check() && auth()->user()->hasRole('admin'))
            ? [
                'full_name' => 'required|string|max:150',
                'email' => 'required|email|max:150|unique:users,email',
                'phone' => 'required',
                'status' => 'required',
                'roles' => 'required',
            ]
            : [
                'full_name' => 'required|string|max:150',
                'email' => 'required|email|max:150|unique:users,email',
                'phone' => 'required',
                'password' => 'required|confirmed'
            ];
    }
}
