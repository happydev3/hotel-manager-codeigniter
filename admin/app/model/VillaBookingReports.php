<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class VillaBookingReports extends Model
{
     /**
     * Added just to demonstrate that models work
     * @return String
     */
   protected $table = 'villa_booking_reports';
   protected $primaryKey = 'report_id';

   //protected $fillable   = ['status'];
   //protected $guarded   = ['user_id','created_at'];

   public function Passengers()
   {
      return $this->hasMany('App\model\VillaBookingPassengersInfo','uniqueRefNo','uniqueRefNo');
   		// return $this->hasMany('App\model\VillaBookingPassengersInfo');
   }
   public function Villas()
   {
   		return $this->hasMany('App\model\VillaBookingVillasInfo','uniqueRefNo','uniqueRefNo');
   }
}
