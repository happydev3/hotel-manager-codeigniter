<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class HotelBookingPassengersInfo extends Model
{

	protected $table = 'hotel_booking_passengers_info';
	protected $primaryKey = 'pass_id';

	public function Reports() {
		return $this->hasMany('App\Models\HotelBookingReports','uniqueRefNo','uniqueRefNo');
	}
}
