<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Auth::loginUsingId(1);
        return auth::user()->role === 'Admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'userCode' => 'sometimes|string|min:4|unique:users,userCode',
            'password' => 'sometimes|string|min:8',
            'role' => 'sometimes|in:Admin,Partner,LabWorker',
            'status' => 'sometimes|in:Active,Inactive',
            'Phone' => 'nullable|string',
        ];
    }
}
