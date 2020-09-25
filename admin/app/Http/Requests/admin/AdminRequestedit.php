<?php

namespace App\Http\Requests\admin;

use App\Http\Requests\Request;

class AdminRequestedit extends Request
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
            'name' => 'required',
            // 'mobile_no' => 'required|digits:10',
            'mobile_no' => 'required',
            'address' => 'required',
            'pin_code' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required'
        ];
    }
}
