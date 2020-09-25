<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class HolidayBookingReports extends Model
{
     /**
     * Added just to demonstrate that models work
     * @return String
     */
   protected $table = 'holiday_booking_reports';
   protected $primaryKey = 'holiday_booking_id';

   //protected $fillable   = ['status'];
   //protected $guarded   = ['user_id','created_at'];

   public function Passengers()
   {
      return $this->hasMany('App\model\HolidayBookingPassengersInfo','uniqueRefNo','uniqueRefNo');
   }
   public function Holidays()
   {
   		return $this->hasMany('App\model\HolidayBookingHolidayInfo','uniqueRefNo','uniqueRefNo');
   }
}
