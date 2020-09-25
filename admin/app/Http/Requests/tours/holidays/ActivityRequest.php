<?php

namespace App\Http\Requests\tours\holidays;

use App\Http\Requests\Request;

class ActivityRequest extends Request
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
            'activity_title' => 'required',
            'operating_hours' => 'required',
            'duration' => 'required',
            'pickup_location' => 'required',
            'pickup_time' => 'required',
            // 'child_allowed_1' => 'required',
            // 'minChildAge' => 'required',
            // 'maxChildAge' => 'required',
            // 'minAdultAge' => 'required',
            // 'minPaxOperating' => 'required',
            // 'maxPaxOperating' => 'required',
            // 'start_date' => 'required',
            // 'end_date' => 'required',
            'price_adt' => 'required',
            'price_chd' => 'required',
            'price_sen' => 'required',
            'activity_desc' => 'required',
            'cancel_policy' => 'required'
        ];
    }
    public function messages() {
        return [
            'activity_title.required'=>'Please enter Activity Title',
            'operating_hours.required'=>'Please enter Operating Hours',
            'duration.required'=>'Please enter Duration',
            'pickup_location.required'=>'Please enter Pickup Location',
            'pickup_time.required'=>'Please enter Pickup Time',
            // 'start_date.required'=>'Please enter Start Date',
            // 'end_date.required'=>'Please enter End Date',
            'price_adt.required'=>'Please enter Price Adult',
            'price_chd.required'=>'Please enter Price Child',
            'price_sen.required'=>'Please enter Price Senior',
            'activity_desc.required'=>'Please enter Short Description',
            'cancel_policy.required'=>'Please enter Cancellation Policy'
        ];
    }
}
