<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'userCode' => 'required|string|min:4|unique:users,userCode',
            'password' => 'required|string|min:8',
            'role' => 'required|in:Admin,Partner,LabWorker',
            'status' => 'required|in:Active,Inactive',
            'Phone' => 'nullable|string',
        ];
    }
}
