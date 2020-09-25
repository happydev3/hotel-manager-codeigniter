<?php

namespace App\Http\Requests\b2b\user;

use App\Http\Requests\Request;

class UserRequest extends Request
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
            'agent_email' => 'required|email|unique:agent_info',
            'user_password' => 'required',
            'passconf' => 'required|same:user_password',
            'title' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile_no' => 'required|digits:10',
            'address' => 'required',
            'pin_code' => 'required',
            'city' => 'required',
            'country' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'user_email.required'=>'Please enter email ID',
            'mobile_no.required'=>'Please enter valid Mobile'
        ];
    }
}
