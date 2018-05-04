<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NurseRequest extends FormRequest
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
            'fullName' => 'required|regex:/^[\pL\s\-]+$/u|min:3|max:35', 
            // to make the name contains only letters,spaces and hyphens
            'email' => 'required|unique:nurses|email',
            'password' => 'required|string|confirmed|min:8',
            'mobile' => 'nullable|numeric|digits_between:8,20',
            'birthday' => 'nullable|date|before:today',
            'start_day'=>'required|alpha',
            'end_day'=>'required|alpha',
            'start_time'=>'required',
            'end_time'=>'required',
            'gender' => [
                    'nullable',
                    Rule::in(['male', 'female']),
                ],
            'salary' => 'required|numeric|min:0',
            'clinic' => 'required|exists:clinics,id'
        ];
    }
}
