<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CitizenRequest extends FormRequest
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
        if(request()->step_no == 1){
            $rules = [
                'country' => ['bail','required','alpha_spaces', 'max:255', 'min:3'],
                'nic' => ['bail','required', 'numeric', 'min:6' , 'digits_between:6,20', 'unique:citizens'],
                'expiry_date' => ['bail','required', 'date'],
                'passport_no' => ['bail','required', 'numeric', 'min:6' , 'digits_between:6,20','unique:citizens'],
                'tax_payer' => ['bail','required', 'boolean'],
                'tax_no' => ['bail','required', 'numeric','unique:citizens'],
            ];
        } else if(request()->step_no == 2){
            $rules = [
                'net_income' => ['bail','required', 'numeric'],
                'source_of_fund' => ['bail','required', 'string'],
            ];
        } else if(request()->step_no == 3){
            $rules = [
                'bank_deposit' => ['bail','required', 'string'],
                'listed_stocks' => ['bail','required', 'string'],
                'private_equities' => ['bail','required', 'string'],
                'real_estate' => ['bail','required', 'string'],
            ];
        } else if(request()->step_no == 4){
            $rules = [
                'passport_scan' => ['bail','required', 'image'],
                'nic_scan' => ['bail','required', 'image'],
                'bill_scan' => ['bail','required', 'image'],
            ];
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nic.unique' => 'This NIC has already registered',
            'passport_no.unique' => 'This Passport has already registered',
            'tax_no.unique' => 'This Tax-# has already registered',
        ];
    }
}
