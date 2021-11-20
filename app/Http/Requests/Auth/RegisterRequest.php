<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Wyattcast44\SafeUsername\Rules\AllowedUsername;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case "POST" :
                return [
                    'name' => ['bail', 'max:255', 'min:3'],
                    'email' => ['bail', 'required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['bail','required', 'string', 'min:6'],
                    'dob' => ['bail','required', 'date',],
                    'roles' => ['required','exists:roles,id'],
                    'status' => ['required'],
                ];
            break;
            case "PUT" :
                return [
                    'name' => ['bail', 'max:255', 'min:3'],
                    'email' => ['bail', 'required', 'string', 'email', 'max:255', 'unique:users,email,'.$this->userId],
                    'password' => ['bail','required', 'string', 'min:6'],
                    'dob' => ['bail','required', 'date',],
                    'roles' => ['required','exists:roles,id'],
                    'status' => ['required'],
                ];
            break;
            default:
            break;
        }
    }
}
