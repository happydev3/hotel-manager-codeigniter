<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class HolidayBookingHolidayInfo extends Model
{

	protected $table = 'holiday_booking_holiday_info';
	protected $primaryKey = 'holiday_info_id';

	public function Reports() {
		return $this->hasOne('App\Models\HolidayBookingReports','uniqueRefNo','uniqueRefNo');
	}
}
