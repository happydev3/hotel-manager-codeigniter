<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class HotelBookingHotelsInfo extends Model
{

	protected $table = 'hotel_booking_hotels_info';
	protected $primaryKey = 'hotel_booking_id';

	public function Reports() {
		return $this->hasOne('App\Models\HotelBookingReports','uniqueRefNo','uniqueRefNo');
	}
}
