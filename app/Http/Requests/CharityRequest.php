<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CharityRequest extends FormRequest
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
                    'title' => 'required',
                    'description' => 'required',
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'teacher' => 'required|exists:users,id',
                    'class' => 'required|exists:classrooms,id|unique:charities,class_id',
                    'tagline' => 'required',
                    'status'    =>  'required'
                ];
                break;
            case "PUT" :
                return [
                    'title' => 'required',
                    'description' => 'required',
                    'teacher' => 'required|exists:users,id',
                    'class' => 'required|exists:classrooms,id|unique:charities,class_id,'.$this->charityId,
                    'imageRemove' => 'nullable',
                    'image' => 'required_if:imageRemove,1|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'tagline' => 'required',
                    'status'    =>  'required'
                ];
                break;
            default:
                break;
        }
    }
}
