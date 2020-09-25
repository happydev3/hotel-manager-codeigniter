<?php

namespace App\Http\Requests\tours\holidays;

use App\Http\Requests\Request;

class HolidayRequest extends Request
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
            'package_title' => 'required',
            'package_code' => 'required',
            'package_rating' => 'required',
            'holiday_theme' => 'required',
            // 'category' => 'required',
            'desti' => 'required',
            'duration' => 'required',
            // 'month' => 'required',
            'checkIn' => 'required',
            'checkOut' => 'required',
            'package_desc' => 'required',
            'additional_info' => 'required',
            'highlight' => 'required',
            'inclusion' => 'required',
            'exclusion' => 'required',
            'price_ad' => 'required',
            'terms' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'package_title.required'=>'Please enter Package Title',
            'package_code.required'=>'Please enter Package Code'
        ];
    }
}
