<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class HotelBookingReports extends Model
{
     /**
     * Added just to demonstrate that models work
     * @return String
     */
   protected $table = 'hotel_booking_reports';
   protected $primaryKey = 'report_id';

   //protected $fillable   = ['status'];
   //protected $guarded   = ['user_id','created_at'];

   public function Passengers()
   {
      return $this->hasMany('App\model\HotelBookingPassengersInfo','uniqueRefNo','uniqueRefNo');
   		// return $this->hasMany('App\model\HotelBookingPassengersInfo');
   }
   public function Hotels()
   {
   		return $this->hasMany('App\model\HotelBookingHotelsInfo','uniqueRefNo','uniqueRefNo');
   }
}
