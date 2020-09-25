<?php

namespace App\Http\Requests\tours\holidays;

use App\Http\Requests\Request;

class MeetingRequest extends Request
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
            'pickup_location' => 'required',
            'pickup_type' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ];
    }
    public function messages() {
        return [
            'pickup_location.required'=>'Please enter Pickup Location',
            'pickup_type.required'=>'Please enter Pickup Type',
            'latitude.required'=>'Please enter Latitude',
            'longitude.required'=>'Please enter Longitude'
        ];
    }
}
