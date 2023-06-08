<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        (auth()->check() && auth()->user()->hasRole('admin')) 
            ? $userId = $this->route('admin.manage-user.update') 
            : $userId = auth()->user()->id;

        $userEmail = User::where('id', $userId)->value('email');

        return (auth()->check() && auth()->user()->hasRole('admin'))
            ? [
                'full_name' => 'required|string|max:150',
                'email' => [
                    'required',
                    'email',
                    'max:150',
                    Rule::unique('users')->ignore($userId, 'id')->where(function ($query) use ($userEmail) {
                        $query->where('email', '==', $userEmail);
                    }),
                ],
                'phone' => 'required',
                'status' => 'required',
                'roles' => 'required',
            ]
            : [
                'full_name' => 'required|string|max:150',
                'email' => [
                    'required',
                    'email',
                    'max:150',
                    Rule::unique('users')->ignore($userId, 'id')->where(function ($query) use ($userEmail) {
                        $query->where('email', '==', $userEmail);
                    }),
                ],
                'phone' => 'required',
                'password' => 'required|confirmed'
            ];
    }
}
