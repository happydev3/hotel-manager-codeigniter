<?php

namespace App\Http\Requests\b2b\holidays;

use App\Http\Requests\Request;

class markupRequest extends Request
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
            'markupprocess' => 'required',
            'markupvalue' => 'required|integer',
            'markupprocess' => 'required'
        ];
    }
     public function messages()
    {
        return [
            'apiname.required' => 'Select Api name',
            'markupvalue.required' => 'Please enter Integer value',
            'markupprocess.required' => 'Markup Type is required'
        ];
    }
}
