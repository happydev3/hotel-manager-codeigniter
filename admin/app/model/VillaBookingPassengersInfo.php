<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class VillaBookingPassengersInfo extends Model
{

	protected $table = 'villa_booking_passengers_info';
	protected $primaryKey = 'pass_id';

	public function Reports() {
		return $this->hasMany('App\Models\VillaBookingReports','uniqueRefNo','uniqueRefNo');
	}
}
