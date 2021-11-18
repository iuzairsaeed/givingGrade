<?php

namespace App\Http\Requests\Auth;

use App\Rules\MatchOldPassword;
use Carbon\Carbon;
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
            'name' => ['bail', 'alpha_spaces', 'max:255', 'min:3'],
            'email' => ['bail', 'required', 'string', 'email', 'max:255','unique:users,email,'.auth()->user()->id],
            'oldPassword' => ['bail', new MatchOldPassword],
            'password' => ['bail','nullable', 'min:6', 'confirmed','different:oldPassword'],
            'dob' => ['bail','required', 'date','before:'.Carbon::Now()],
            'students' => ['bail','required'],
            'grade' => ['bail','required'],
            'subjects.*' => ['bail','required','exists:subjects,id'],
            'school' => ['bail','required'],
            'imageRemove' => 'nullable',
            'avatar' => 'required_if:imageRemove,1|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
