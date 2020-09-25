<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class HolidayBookingPassengersInfo extends Model
{

	protected $table = 'holiday_booking_passenger_info';
	protected $primaryKey = 'holi_pass_id';

	public function Reports() {
		return $this->hasMany('App\Models\HolidayBookingReports','uniqueRefNo','uniqueRefNo');
	}
}
