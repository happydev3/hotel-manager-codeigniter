<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class VillaBookingVillasInfo extends Model
{

	protected $table = 'villa_booking_villa_info';
	protected $primaryKey = 'villa_booking_id';

	public function Reports() {
		return $this->hasOne('App\Models\VillaBookingReports','uniqueRefNo','uniqueRefNo');
	}
}
