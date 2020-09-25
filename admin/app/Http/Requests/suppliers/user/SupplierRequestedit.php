<?php

namespace App\Http\Requests\suppliers\user;

use App\Http\Requests\Request;

class SupplierRequestedit extends Request
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
            'title' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            // 'mobile_no' => 'required|digits:10',
            'address' => 'required',
            // 'pin_code' => 'required',
            'city' => 'required',
            'country' => 'required'
        ];
    }
}
