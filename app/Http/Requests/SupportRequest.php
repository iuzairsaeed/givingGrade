<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupportRequest extends FormRequest
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
            'title' => ['bail','required','alpha_spaces', 'max:255', 'min:3'],
            'email' => ['bail','required', 'string', 'email', 'max:255'],
            'message' => ['bail','required', 'string', 'min:10' , 'max:400'],
            'phone' => ['bail','required','regex:/[0-9+*-*]/'],
        ];
    }
    
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            // "phone.required"=>"The phone number is required",
            // "phone.regex"=>"The phone number is required",
        ];
    }

}
