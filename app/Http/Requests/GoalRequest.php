<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class GoalRequest extends FormRequest
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
                    'charity' => 'required|exists:charities,id|unique:goals,charity_id',
                    'target' => 'required',
                    'startDate'  =>  'required|date|after_or_equal:'.Carbon::NOW()->format('d-m-Y'),
                    'endDate'    =>  'required|date|after:start_date',
                    'status'    =>  'required',
                    'student'    =>  'required'
                ];
                break;
            case "PUT" :
                return [
                    'title' => 'required',
                    'description' => 'required',
                    'imageRemove' => 'nullable',
                    'image' => 'required_if:imageRemove,1|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'charity' => 'required|exists:charities,id|unique:goals,charity_id,'.$this->goalId,
                    'target' => 'required',
                    'startDate'  =>  'required|date|after_or_equal:'.Carbon::NOW()->format('d-m-Y'),
                    'endDate'    =>  'required|date|after:start_date',
                    'status'    =>  'required',
                    'student'    =>  'required'
                ];
                break;
            default:
                break;
        }
    }

    public function messages()
    {
        return [
            'image.required_if' => 'Please upload image.'
        ];
    }
}
