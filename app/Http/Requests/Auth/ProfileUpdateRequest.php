<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
        return [
            'address' => ['bail', 'required', 'string', 'max:255', 'min:3'],
            'street' => ['bail', 'required', 'string', 'max:225', 'min:3'],
            'city' => ['bail', 'required', 'string', 'max:50', 'min:3'],
            'zipcode' => ['bail', 'required', 'string', 'max:50', 'min:3'],
        ];
    }
}
