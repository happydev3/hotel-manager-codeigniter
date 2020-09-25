<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ApiPermanentHotels extends Model {
	
	public $timestamps = false;
	protected $table = 'api_permanent_hotels';
	protected $primaryKey = 'api_hotel_id';
	protected $guarded   = ['api_hotel_id'];
      
}